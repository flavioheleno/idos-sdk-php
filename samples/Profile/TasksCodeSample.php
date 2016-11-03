<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../settings.php';

/**
 * For instantiating the $sdk object, responsible to call the endpoints, its necessary to create the $auth object.
 * The $auth object can instantiate the CredentialToken class, IdentityToken class, UserToken class or None class. They are related to the type of authorization required by the endpoint.
 * Passing through the CredentialToken constructor: the credential public key, handler public key and handler private key, so the auth token can be generated.
 */
$auth = new \idOS\Auth\CredentialToken(
    $credentials['credentialPublicKey'],
    $credentials['handlerPublicKey'],
    $credentials['handlerPrivKey']
);

/**
 * The proper way to call the endpoints is to statically calling the create method of the SDK class.
 * The static method create($auth) creates a new instance of the SDK class.
 */
$sdk = \idOS\SDK::create($auth);

/**
 * To start making requests to the Tasks endpoint, its necessary to provide the process id, and the tasks is going to be related related to this process id. Therefore, in this sample, it lists all processes related to the provided username.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Processes
    ->listAll();

/**
 * Stores the process id of the first index of the api call response.
 */
$processId = $response['data'][0]['id'];

/**
 * Lists all tasks related to the provided username and the provided processId.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Process($processId)
    ->Tasks
    ->listAll();

/**
 * Prints api call response to Tasks endpoint.
 */
echo 'List All:', PHP_EOL;
foreach ($response['data'] as $task) {
    print_r($task);
    echo PHP_EOL;
}

/**
 * Creates a new task.
 * To create a new task, its necessary to call the createNew() method passing as parameter the task name, the task event, the boolean value for running status, the boolean value for the sucess status and, finally, the message. Note: The message parameter is optional.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Process($processId)
    ->Tasks
    ->createNew('Testing', 'testing', false, true, 'message');

/**
 * Checks if the task was created before calling other methods related to the tasks endpoint that requires an existing task.
 */
if ($response['status'] === true) {

    /**
     * Stores the task id of the task created.
     */
    $taskId = $response['data']['id'];

    /**
     * Updates the task created passing as parameter the stored $taskId, task name, the task event, the boolean value for running status, the boolean value for the sucess status and, finally, the message.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Process($processId)
        ->Tasks
        ->updateOne($response['data']['id'], 'Test', 'test', true, false, 'dummy-message');

    /**
     * Prints api call response to Tasks endpoint.
     */
    echo 'Update One:', PHP_EOL;
    print_r($response['data']);
    echo PHP_EOL;

    /**
     * Retrieves information of the task created giving the stored $taskId.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Process($processId)
        ->Tasks
        ->getOne($response['data']['id']);

    /**
     * Prints api call response to Tasks endpoint.
     */
    echo 'Get one: ', PHP_EOL;
    print_r($response['data']);
    echo PHP_EOL;
}
