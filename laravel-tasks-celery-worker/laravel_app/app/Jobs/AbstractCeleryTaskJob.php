<?php

namespace App\Jobs;

use Celery;

abstract class AbstractCeleryTaskJob implements ICeleryTaskJob
{
    /**
     * @var Celery
     */
    private $client;

    /**
     * Get the Celery client for connecting to the queue
     *
     * @return Celery
     */
    private function getClient(): Celery
    {
        if (!$this->client) {

            //load the celery client with set configuration
            $this->client = new Celery(
                config('celery.host'),
                config('celery.user'),
                config('celery.password'),
                config('celery.vhost'),
                config('celery.exchange'),
                config('celery.binding'),
                config('celery.port'),
                config('celery.connector'),
                config('celery.persistent_messages'),
                config('celery.result_expire'),
                config('celery.ssl_options')
            );
        }

        return $this->client;
    }

    /**
     * Send the job to the celery task queue
     *
     * @param       $taskName
     * @param array $args
     *
     * @throws \CeleryException
     * @throws \CeleryPublishException
     *
     * @return \AsyncResult
     */
    protected function send($taskName, array $args = []): \AsyncResult
    {
        $client = $this->getClient();

        return $client->PostTask($taskName, $args);
    }
}
