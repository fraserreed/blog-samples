<?php

return [
    'host'                => 'redis',
    'user'                => null,
    'password'            => null,
    'vhost'               => 0,
    'exchange'            => 'celery',
    'binding'             => 'celery',
    'port'                => 6379,
    'connector'           => 'redis',
    'persistent_messages' => false,
    'result_expire'       => 0,
    'sslOptions'          => [],
];
