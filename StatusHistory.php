<?php
namespace tonisormisson\statushistory;

use andmemasin\myabstract\ModelWithHasStatus;
use yii\base\Widget;
use yii\data\ArrayDataProvider;
use yii\i18n\PhpMessageSource;

class StatusHistory extends Widget
{
    /** @var ModelWithHasStatus */
    public $model;

    /** @var string  */
    public $id = 'status-history';

    /** @var bool */
    public $showTitle = true;

    public $dataProviderOptions = [];


    public function run()
    {
        $this->registerTranslations();

        $dataProvider = $provider = new ArrayDataProvider([
            'allModels' => $this->model->hasStatuses,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => ['id','status'],
            ],
        ]);

        if (!empty($this->dataProviderOptions)) {
            foreach ($this->dataProviderOptions as $key => $value) {
                $dataProvider->{$key} = $value;
            }
        }

        return $this->render('list', [
            'widget' => $this,
            'dataProvider' => $dataProvider
        ]);
    }
    public function registerTranslations()
    {
        \Yii::$app->i18n->translations['tostatus'] = [
            'class' => PhpMessageSource::class,
            'sourceLanguage' => 'en-US',
            'basePath' => '@tonisormisson/addressform/messages',
        ];
    }
}