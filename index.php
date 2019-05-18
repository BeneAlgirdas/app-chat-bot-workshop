<?php

include (__DIR__ . '/vendor/autoload.php');

use Service\ConfigProvider;

$clientInit = new \Service\ClientInit();

$configProvider = new ConfigProvider( __DIR__ . '/config.json');

if(isset($_REQUEST['hub_challenge'])) {
    $challenge = $_REQUEST['hub_challenge'];
    if ($_REQUEST['hub_verify_token'] === $configProvider->getParameter('verify_token')) {
        echo $challenge; die();
    }
}

$input = json_decode(file_get_contents('php://input'), true);

if ($input === null) {
    exit;
}

$message = $input['entry'][0]['messaging'][0]['message']['text'];
$sender = $input['entry'][0]['messaging'][0]['sender']['id'];

$fb = new Facebook\Facebook([
    'app_id' => $configProvider->getParameter('app_id'),
    'app_secret' => $configProvider->getParameter('app_secret')
]);

$data = [
    'messaging_type' => 'RESPONSE',
    'recipient' => [
        'id' => $sender,
    ],
    'message' => [
        'text' => 'You question: ', getQuestion() ,
    ]
];

$response = $fb->post('/me/messages', $data, $configProvider->getParameter('access_token'));