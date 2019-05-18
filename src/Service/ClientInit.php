<?php


namespace Service;
use GuzzleHttp\Client;


class ClientInit
{
    private $client;
    private $response_array;

    public function __construct($client)
    {
        $this->client = $client;
        $this->response_array = [];

    }

    public function formResponse()
    {
        $response_json = $this->client->get(
            'https://opentdb.com/api.php',
            [
                'query' => [
                    'diffulty' => 'easy',
                    'amount' => 1,
                ]
            ]
        );
        $this->response_array = json_decode($response_json->getBody()->getContents(), true);
    }

    public function getQuestion()
    {
        return $this->response_array['results'][0]['question'];
    }

    public function getAnswer()
    {
        return $this->response_array['results'][0]['correct_answer'];
    }

//    public function sendQuestion($sender, $me){
//        $sender = 'app_id';
//        ;
//    }

}