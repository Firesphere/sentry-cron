<?php

namespace Firesphere\SentryCron;

use GuzzleHttp\Client;

trait SentryTrait
{

    /**
     * @var int Timestamp
     */
    protected $start;

    /**
     * @var string ID of the checkin
     */
    protected $checkinId;

    /**
     * @var string URI to post to
     */
    protected $uri;

    /**
     * @var Client Guzzle http client
     */
    protected $client;

    public function start($dsn, $monitorId)
    {
        $this->start = time();
        $this->getClient($dsn);

        $this->uri = sprintf('/api/0/monitors/%s/checkins/', $monitorId);

        $response = $this->client->post($this->uri, [
            'json' => [
                'status' => 'in_progress'
            ]
        ]);

        $decode = json_decode($response->getBody()->getContents(), true);

        $this->checkinId = $decode['id'];
    }

    public function end($error = false)
    {
        $endpoint = sprintf('%s%s/', $this->uri, $this->checkinId);

        $this->client->put($endpoint, [
            'json' => [
                'status' => $error ? 'error' : 'ok',
                'duration' => time() - $this->start
            ]
        ]);
    }

    /**
     * @param $dsn
     * @return void
     */
    protected function getClient($dsn): void
    {
        $this->client = new Client([
            'base_uri' => 'https://sentry.io',
            'headers'  => [
                'Authorization' => sprintf('DSN %s', $dsn),
                'Content-Type'  => 'application/json'
            ],
        ]);
    }
}