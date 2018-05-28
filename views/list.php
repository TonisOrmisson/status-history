<?php
/** @var \tonisormisson\statushistory\StatusHistory $widget */
/** @var \yii\data\ArrayDataProvider $dataProvider */

use yii\helpers\Html;
use yii\widgets\ListView;

$formatter = new \yii\i18n\Formatter();

?>
<div id="<?=$widget->id?>">
    <?php if($widget->showTitle):?>
    <h3><?= Html::encode(Yii::t('tostatus','Status history'))?></h3>
    <?php endif;?>
    <?=
    ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' =>
            function ($model) use ($formatter) {
                /** @var $model \andmemasin\myabstract\HasStatusModel */
                $user = $model->getUserCreated();
                return $formatter->asDatetime($model->timeCreated)
                    . ' - '
                    . $model->statusModel->label
                    . ' ('. Html::encode($user->username).')'
                    ;
            },
    ]);
    ?>

</div>