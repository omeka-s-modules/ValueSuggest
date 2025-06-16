<?php

namespace ValueSuggest\Updater;

use Laminas\Http\Client as HttpClient;
use Laminas\Http\Request;
use Laminas\Log\Logger;
use Omeka\Entity\Value;

class IdRefUpdater implements UpdaterInterface
{
    protected HttpClient $httpClient;
    protected Logger $logger;

    public function __construct(HttpClient $httpClient, Logger $logger)
    {
        $this->httpClient = $httpClient;
        $this->logger = $logger;
    }

    public function update(Value $value): bool
    {
        $logger = $this->logger;

        $uri = $value->getUri();
        if (!$uri) {
            $logger->warn(sprintf('IdRefUpdater: value does not have an URI (id: %d)', $value->getId()));
            return false;
        }

        $matches = [];
        if (!preg_match('~https?://www.idref.fr/([0-9X]{9})~', $uri, $matches)) {
            $logger->warn(sprintf('IdRefUpdater: value URI does not match typical IdRef URI (id: %d, uri: %s)', $value->getId(), $uri));
            return false;
        }

        $ppn = $matches[1];
        $solrUri = sprintf('https://www.idref.fr/Sru/Solr?wt=json&fl=affcourt_z&q=ppn_z:%s', urlencode($ppn));
        $request = new Request;
        $request->setUri($solrUri);
        $response = $this->httpClient->send($request);
        if (!$response->isSuccess()) {
            $logger->warn(sprintf('IdRefUpdater: request to IdRef failed (uri: %s, status code: %d)', $solrUri, $response->getStatusCode()));
            return false;
        }

        $json = $response->getContent();
        $data = json_decode($json, true);
        if (!$data) {
            $logger->warn(sprintf('IdRefUpdater: failed to parse response as JSON: %s', json_last_error_msg()));
            return false;
        }

        $docs = $data['response']['docs'];
        if (empty($docs)) {
            $logger->warn(sprintf('IdRefUpdater: no record found for PPN "%s"', $ppn));
            return false;
        }

        $label = $docs[0]['affcourt_z'];
        if (!$label) {
            $logger->warn(sprintf('IdRefUpdater: record found for PPN "%s" has no "affcourt_z"', $ppn));
            return false;
        }

        if ($value->getValue() === $label) {
            // Nothing to update, do not log anything as it is the most common case.
            return false;
        }

        $logger->info(
            sprintf(
                'IdRefUpdater: value %d updated ("%s" -> "%s") for resource %d',
                $value->getId(),
                $value->getValue(),
                $label,
                $value->getResource()->getId()
            )
        );

        $value->setValue($label);

        return true;
    }
}
