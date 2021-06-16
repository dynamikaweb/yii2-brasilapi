<?php 

namespace dynamikaweb\brasilapi;

use Yii;
use yii\web\Response;

class Module extends \yii\base\Module
{

    public function init()
    {
        parent::init();

        Yii::$app->response->format = Response::FORMAT_JSON;
        Yii::$app->response->on(Response::EVENT_BEFORE_SEND,  function ($event) {
            $response = $event->sender;
            $response->data = [
                'success' => $response->isSuccessful,
                'data' => $response->data,
            ];
        });

        return true;
    }
}
