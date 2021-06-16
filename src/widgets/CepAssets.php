<?php

namespace dynamikaweb\brasilapi\widgets;

use Yii;
use yii\web\AssetBundle;

class CepAssets extends AssetBundle
{
    public $sourcePath = '@vendor/dynamikaweb/yii2-brasilapi/assets';

    public $css = [];

    public $js = [
        'js/cep.js'
    ];

    public $depends = [];

}
