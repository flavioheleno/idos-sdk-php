<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../settings.php';

/**
 * Creates an auth object for a CredentialToken required in the SDK constructor for calling all endpoints. Passing through the CredentialToken constructor: the credential public key, handler public key and handler private key, so the auth token can be generated.
 */
$auth = new \idOS\Auth\CredentialToken(
    $credentials['credentialPublicKey'],
    $credentials['handlerPublicKey'],
    $credentials['handlerPrivKey']
);

/**
 * Calls the create method that instantiates the SDK passing the auth object trought the constructor.
 */
$sdk = \idOS\SDK::create($auth);

/**
 * Calling the Profile Class passing the username, and after that, the Processes Endpoint and the method listAll to get a random process id.
 *
 * @var [type]
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Processes
    ->listAll();

$processId = $response['data'][0]['id'];

/**
 * Calling the Profile Class passing the username, and after that, the Process Class passing the $processId trough the constructor. After that calls the Task Ednpoint and the method listAll.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Process($processId)
    ->Tasks
    ->listAll();

/**
 * Prints the response.
 */
print_r("\nList All:");
foreach ($response['data'] as $task) {
    print_r("\nID: " . $task['id']);
    print_r("\nName: " . $task['name']);
    print_r("\nEvent: " . $task['event']);
    print_r("\nSuccess: " . $task['success']);
    print_r("\n");
}

/**
 * Creates a new task.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Process($processId)
    ->Tasks
    ->createNew('Testing', 'testing', true, true, '');

/**
 * Prints the response.
 */
print_r("\nCreate New: ");
print_r("\nID: " . $response['data']['id']);
print_r("\nName: " . $response['data']['name']);
print_r("\nEvent: " . $response['data']['event']);
print_r("\nSuccess: " . $response['data']['success']);
print_r("\n");

/**
 * Updates a task.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Process($processId)
    ->Tasks
    ->updateOne($response['data']['id'], 'Test', 'test', false, false, 'dummy-message');

/**
 * Prints the response.
 */
print_r("\nUpdate One: ");
print_r("\nID: " . $response['data']['id']);
print_r("\nName: " . $response['data']['name']);
print_r("\nEvent: " . $response['data']['event']);
print_r("\nSuccess: " . $response['data']['success']);
print_r("\n");


/**
 * Gets one task.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Process($processId)
    ->Tasks
    ->getOne($response['data']['id']);

/**
 * Prints the response.
 */
print_r("\nGet One: ");
print_r("\nID: " . $response['data']['id']);
print_r("\nName: " . $response['data']['name']);
print_r("\nEvent: " . $response['data']['event']);
print_r("\nSuccess: " . $response['data']['success']);
print_r("\n");
