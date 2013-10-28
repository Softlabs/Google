<?php namespace Softlabs\Google;

use \Config as Config;

class Google
{

    public function __construct() {

        $config = array(
            'oauth2_client_id' => Config::get('google.client-id'),
            'use_objects' => true,
        );

        $this->client = new \Google_Client($config);

        $this->client->setAccessType('offline');

        $this->client->setAssertionCredentials(
            new \Google_AssertionCredentials(
                Config::get('google.service-account-name'),
                Config::get('google.scope'),
                file_get_contents(Config::get('google.key-file'))
            )
        );
    }

    /**
     * Creates a google service.
     *
     * @param $serviceName string Service name.
     */
    public function createService($serviceName)
    {
        $className = "\Google_" . $serviceName . "Service";
        $service = new $className($this->client);

        return $service;
    }

}