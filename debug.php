<?php

use GuzzleHttp\Client;
use Service\ClientInit;

include (__DIR__ . '/vendor/autoload.php');

$client = new Client();
$clientInit = new ClientInit($client);

//var_dump(json_decode($client->get('https://opentdb.com/api.php?difficulty=easy&amount=1')->getBody()->getContents()), true);
var_dump(json_decode($clientInit->getQuestion()));