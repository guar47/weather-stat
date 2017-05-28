<?php

namespace app\commands;

use app\models\Weather;
use \yii\console\Controller;
use yii\httpclient\Client;


class WeatherController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actionIndex()
    {
        $client = new Client([
            'baseUrl' => 'https://api.awhere.com/',
            'transport' => 'yii\httpclient\CurlTransport'
        ]);
        $token = $this->getToken($client);

//      check created fields
        $responseFields = $client->createRequest()
            ->setMethod('get')
            ->setUrl('v2/fields')
            ->addHeaders([
                'Authorization' => 'Bearer ' . $token
            ])
            ->send();
//      create the field if doesn't exist
        if (count($responseFields->data['fields']) < 1) {
            $client->createRequest()
                ->setMethod('post')
                ->setFormat(Client::FORMAT_JSON)
                ->setUrl('v2/fields')
                ->addHeaders([
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json'
                ])
                ->setData([
                    'id' => '1',
                    'farmId' => '1',
                    'centerPoint' => ['latitude' => Weather::MOSCOW_LATITUDE, 'longitude' => Weather::MOSCOW_LONGITUDE]
                ])
                ->send();
        }

        for ($i = 11; $i < 13; $i++) {
            $timestamp = strtotime('2016-' . $i);
            $startDate = date('Y-m-01', $timestamp);
            $endDate = date('Y-m-t', $timestamp);

            $responseWeather2017 = $client->createRequest()
                ->setMethod('get')
                ->setUrl('/v2/weather/fields/1/observations/' . $startDate . ',' . $endDate)
                ->addHeaders([
                    'Authorization' => 'Bearer ' . $token
                ])
                ->send();

            var_dump($responseWeather2017->data);

            foreach ($responseWeather2017->data['observations'] as $dayWeather) {
                $weather = new Weather();
                $weather->date = $dayWeather['date'];
                $weather->hour = 00;
                $weather->temp = ($dayWeather['temperatures']['max'] + $dayWeather['temperatures']['min']) / 2;
                $weather->city = 'Moscow';
                $weather->save();
            }
        }
    }

    /**
     * @param $http_client
     * @return string
     */
    public function getToken(Client $http_client)
    {
        $token = $http_client->createRequest()
            ->setMethod('post')
            ->setUrl('oauth/token')
            ->addHeaders([
                'Authorization' => 'Basic ' . base64_encode('6GG5LdueHWKG4hIpKAP2a1EO1NQkvYmk:ZGBca9ezJfIo54Ir'),
                'Content-Type' => 'application/x-www-form-urlencoded'
            ])
            ->addData(['grant_type' => 'client_credentials'])
            ->send();

        return $token->data['access_token'];
    }
}