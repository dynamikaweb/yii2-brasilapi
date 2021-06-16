<?php

namespace dynamikaweb\brasilapi\widgets;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\widgets\InputWidget;

class CepWidget extends InputWidget
{

    public const PLUGIN_NAME = 'inputcep';

    public const TEMPLATE_MATERIALIZE = 'materialize';

    public $searchIcon = null;
    
    public $options = ['class' => 'form-control'];

    public $type = 'text';

    public $_hashVar;

    /**
     * @var array $fields ID of html elements that will receive result of search
     * ```php
     * [
     *     'location' => 'location_input_id',
     *     'district' => 'district_input_id',
     *     'city' => 'city_input_id',
     *     'state' => 'state_input_id',
     * ]
     * ```
     */
    public $fields = [
        'street' => '',
        'neighborhood' => '',
        'city' => '',
        'state' => '',
    ];

    public $action = '/brasilapi/cep/v2/';

    public $template;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        CepAssets::register($this->view);
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->registerClientScript();
        if ($this->hasModel()) {
            return Html::activeInput($this->type, $this->model, $this->attribute, $this->options);
        }
        return Html::input($this->type, $this->name, $this->value, $this->options);
    }

    protected function hashPluginOptions($id)
    {
        $this->_hashVar = self::PLUGIN_NAME . '_' . hash('crc32', 'inputcep-'.$id);
        $this->options['data-plugin-' . self::PLUGIN_NAME] = $this->_hashVar;
    }

    protected function registerClientScript()
    {
        $id = $this->options['id'];
        $this->hashPluginOptions($id);
        $options = Json::encode([
            'fields' => $this->fields,
            'action' => Url::to($this->action),
            'template' => $this->template
        ]);

        $this->view->registerJs('jQuery("[data-plugin-'.self::PLUGIN_NAME.'=\''.$this->_hashVar.'\']").cep('.$options.');');
    }
} 