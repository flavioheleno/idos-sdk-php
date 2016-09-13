<?php

namespace idOS\Facade\Profile;

use GuzzleHttp\Client;
use idOS\Auth;
use idOS\Endpoint\Raw as RawEndpoint;

class Raw {

    private static function getInstance(
        string $userName,
        Auth $auth
    ) : RawEndpoint {
        return new RawEndpoint (
            $userName,
            $auth,
            new Client()
        );
    }

    public static function createNew(
        string $userName,
        int $sourceId,
        string $collectionName,
        array $data,
        Auth $auth
    ) {
        return static::getInstance()
            ->createNew($sourceId, $collectionName, $data);
    }

    public static function listAll(
        string $userName,
        Auth $auth,
        array $filters = []
    ) {
        return static::getInstance()
            ->listAll($filters);
    }
}
