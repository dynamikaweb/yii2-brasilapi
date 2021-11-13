dynamikaweb/yii2-brasilapi
=========================
![php version](https://img.shields.io/packagist/php-v/dynamikaweb/yii2-brasilapi)
![pkg version](https://img.shields.io/packagist/v/dynamikaweb/yii2-brasilapi)
![license](https://img.shields.io/packagist/l/dynamikaweb/yii2-brasilapi)
![quality](https://img.shields.io/scrutinizer/quality/g/dynamikaweb/yii2-brasilapi)
![build](https://img.shields.io/scrutinizer/build/g/dynamikaweb/yii2-brasilapi)

Description
-----------
This library has the functionality to consume data from [BrasilAPI](https://brasilapi.com.br/), and process this data in the form of widgets. See full [API documentation](https://brasilapi.com.br/docs)

Installation
------------
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```SHELL
$ composer require dynamikaweb/yii2-brasilapi "*"
```

or add

```JSON
"dynamikaweb/yii2-brasilapi": "*"
```

to the `require` section of your `composer.json` file.

Usage
-----

add the rule to your urlManager component and also add modules
```PHP
    'components' =>[
        'urlManager' => [
            ...
            'rules' => [
                'brasilapi/<route:[a-zA-Z0-9\/-]+>' => 'brasilapi/request/index',
            ]
        ]
    ],
    ...
    'modules' => [
        'brasilapi' =>  [
            'class' => '\dynamikaweb\brasilapi\Module'
        ],
    ]
```

Widgets
-------
this widget will consume the data obtained by the api and distribute it in the fields informed in the options. 

```PHP

```

### Widget Cep
Remembering that the corresponding `IDs` must be added to fill in correctly.
If you are using MaterializeCSS add the option `'template' => CepWidget::TEMPLATE_MATERIALIZE`.

```PHP
use dynamikaweb\brasilapi\widgets\CepWidget;
...
echo $form->field($model, 'cep')->widget(CepWidget::className(), [
    //'template' => CepWidget::TEMPLATE_MATERIALIZE,
    'fields' => [
        'street' => 'id-model-street',
        'neighborhood' => 'id-model-neighborhood',
        'city' => 'id-model-city',
        'state' => 'id-model-state',
    ]
]);
```
or
```PHP
echo CepWidget::widget([
    'fields' => [
        'street' => 'id-model-street',
        'neighborhood' => 'id-model-neighborhood',
        'city' => 'id-model-city',
        'state' => 'id-model-state',
    ]
]);

```

--------------------------------------------------------------------------------------------------------------
[![dynamika soluções web](https://avatars.githubusercontent.com/dynamikaweb?size=12)](https://dynamika.com.br)
This project is under [BSD-3-Clause](https://opensource.org/licenses/BSD-3-Clause) license.
