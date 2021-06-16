<?php

namespace dynamikaweb\brasilapi\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\web\HttpException;
use Curl\Curl;

/**
 * Request controller
 */
class RequestController extends Controller
{
    const URL_API_BRASIL = 'https://brasilapi.com.br/api/';

    public function actionIndex($route)
    {
        $url = self::URL_API_BRASIL . $route;

        $curl = new Curl();
        $curl->get($url);

        $response = Json::decode($curl->response);

        if ($curl->error) {
            throw new HttpException($curl->error_code, ArrayHelper::getValue($response,'message', 'Erro desconhecido'));
        }

        return $response;

    }
    
}
