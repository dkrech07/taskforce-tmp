<?php

namespace app\components;

use Yii;
use yii\base\Component;
use app\services\CityService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Request;

class GeocoderClient extends Component
{
    const BASE_URL = 'https://geocode-maps.yandex.ru/1.x/';

    /**
     * @param string $geocode
     * @return array
     */
    public function getCoords(string $geocode): array
    {
        $client = new Client(['base_uri' => self::BASE_URL]);

        try {
            $request = new Request('GET', '');
            $response = $client->send($request, [
                'query' => [
                    'geocode' => $geocode,
                    'apikey' => Yii::$app->params['geocoderApiKey'],
                    'format' => 'json'
                ]
            ]);

            if ($response->getStatusCode() !== 200) {
                $message = 'Response error: ' . $response->getReasonPhrase();
                throw new BadResponseException($message);
            }

            $content = $response->getBody()->getContents();
            $responseData = json_decode($content, associative: false);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new ServerException('Invalid json format', $request);
            }

            $featureMembers = $responseData
                ->response
                ->GeoObjectCollection
                ->featureMember;

            $result = [];

            foreach ($featureMembers as $i => $featureMember) {
                $geoObject = $featureMember->GeoObject;
                $GeocoderMetaData = $geoObject->metaDataProperty->GeocoderMetaData;
                $components = $GeocoderMetaData->Address->Components;
                $locality = array_values(array_filter($components, fn ($city) => $city->kind === 'locality'))[0] ?? null;

                $result[$i] = [
                    'pos' => explode(' ', $geoObject->Point->pos),
                    'text' => $GeocoderMetaData->text,
                    'city' => $locality?->name
                ];
            }
        } catch (RequestException $ex) {
            $result = [];
        }

        return $result;
    }
}
