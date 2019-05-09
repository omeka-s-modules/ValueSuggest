<?php
namespace ValueSuggest\Suggester\Pactols;

use ValueSuggest\Suggester\SuggesterInterface;
use Zend\Http\Client;

class PactolsSujets implements SuggesterInterface
{
    /**
     * @var Clientx
     */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Retrieve suggestions from the Opentheso 
     *
     *
     * @param string $query
     * @return array
     */
    public function getSuggestions($query, $lang = null)
    {			
        $params = ['q' => $query, 'theso' => 'TH_1', 'group' => '6', 'format' => 'jsonld'];
        if ($lang) {
            // Pactols requires an ISO-639 2-letter language code. Remove the
            // first underscore and anything after it ("zh_CN" becomes "zh").
            $params['lang'] = strstr($lang, '_', true) ?: $lang;
        }
        $response = $this->client
	->setUri('https://pactols.frantiq.fr/opentheso/api/search')
        ->setParameterGet($params)
        ->send();
		
        if (!$response->isSuccess()) {
            return [];
        }
		
        // Parse the JSON response.
        $suggestions = [];
        $results = json_decode($response->getBody(),true);
		
        for($i=0;$i<sizeof($results);$i++) {
            $valueLang="";
            for($j=0; $j<sizeof($results[$i]["http://www.w3.org/2004/02/skos/core#prefLabel"]); $j++){


                    if(strcasecmp(trim($results[$i]["http://www.w3.org/2004/02/skos/core#prefLabel"][$j]['@language']),$lang)==0){
                            $valueLang=$results[$i]["http://www.w3.org/2004/02/skos/core#prefLabel"][$j]['@value'];

                            $suggestions[] = [
                                    'value' =>$valueLang,
                                    'data' => [
                                            'uri' => sprintf('%s', $results[$i]['@id']),
                                            'info' =>sprintf('%s', $results[$i]['@type'][0]),
                                    ],
                            ];

                    }
            }
	}
           return $suggestions;
    }
}


