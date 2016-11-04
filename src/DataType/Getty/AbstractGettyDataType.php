<?php
namespace ValueSuggest\DataType\Getty;

use ValueSuggest\DataType\AbstractDataType;

abstract class AbstractGettyDataType extends AbstractDataType
{
    const ENDPOINT = 'http://vocab.getty.edu/sparql.json';

    /**
     * Get the skos:inScheme portion of the SPARQL query.
     *
     * @return string
     */
    abstract function getScheme();

    /**
     * Retrieve suggestions from the Getty Vocabularies SPARQL endpoint.
     *
     * @see http://vocab.getty.edu/
     * @param string $query
     * @return array
     */
    public function getSuggestions($query)
    {
        $sparqlQuery = sprintf('
select ?Term {
  ?Subject a skos:Concept ;
  luc:term "%s" ;
  skos:inScheme %s: ;
  gvp:prefLabelGVP [xl:literalForm ?Term] .
} order by asc(lcase(str(?Term)))',
            addslashes($query),
            $this->getScheme()
        );
        $client = $this->services->get('Omeka\HttpClient')
            ->setUri(self::ENDPOINT)
            ->setParameterGet([
                'query' => $sparqlQuery,
            ]);

        // Must include Accept header or endpoint returns 400 Bad Request with
        // message: "The request sent by the client was syntactically incorrect."
        $client->getRequest()->getHeaders()->addHeaderLine('Accept', 'application/sparql-results+json');
        $response = $client->send();
        if (!$response->isSuccess()) {
            return [];
        }

        // Parse the JSON response.
        $suggestions = [];
        $results = json_decode($response->getBody(), true);
        foreach ($results['results']['bindings'] as $result) {
            $suggestions[] = $result['Term']['value'];
        }

        return $suggestions;
    }
}
