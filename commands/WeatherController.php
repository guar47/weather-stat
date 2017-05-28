<?php

namespace app\commands;

use \yii\console\Controller;
use yii\httpclient\Client;


class WeatherController extends Controller
{
    public function actionIndex()
    {
//      create http client
        $client = new Client([
            'baseUrl' => 'https://api.awhere.com/',
            'transport' => 'yii\httpclient\CurlTransport'
        ]);
//      get token
        $token = $client->createRequest()
            ->setMethod('post')
            ->setUrl('oauth/token')
            ->addHeaders([
                'Authorization' => 'Basic ' . base64_encode('6GG5LdueHWKG4hIpKAP2a1EO1NQkvYmk:ZGBca9ezJfIo54Ir'),
                'Content-Type' => 'application/x-www-form-urlencoded'
            ])
            ->addData(['grant_type' => 'client_credentials'])
            ->send();
//      check created fields
        $response_fields = $client->createRequest()
            ->setMethod('get')
            ->setUrl('v2/fields')
            ->addHeaders([
                'Authorization' => 'Bearer ' . $token->data['access_token']
            ])
            ->send();
//      create the field if doesn't exist
        if(count($response_fields->data['fields']) < 1) {
            $client->createRequest()
                ->setMethod('post')
                ->setFormat(Client::FORMAT_JSON)
                ->setUrl('v2/fields')
                ->addHeaders([
                    'Authorization' => 'Bearer ' . $token->data['access_token'],
                    'Content-Type' => 'application/json'
                ])
                ->setData([
                    'id' => '1',
                    'farmId' => '1',
                    'centerPoint' => ['latitude' => 55.753492, 'longitude' => 37.620479]
                ])
                ->send();
        }

        $response_weather = $client->createRequest()
            ->setMethod('get')
            ->setUrl('/v2/weather/fields/1/norms/01-01/years/2014,2017')
            ->addHeaders([
                'Authorization' => 'Bearer ' . $token->data['access_token']
            ])
            ->send();


        var_dump($response_weather->data);
    }
}