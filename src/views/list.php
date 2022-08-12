<?php
/** @var tonisormisson\statushistory\StatusHistory $widget */
/** @var yii\data\ArrayDataProvider $dataProvider */

use yii\helpers\Html;
use yii\widgets\ListView;

$formatter = Yii::$app->formatter;

?>
<div id="<?=$widget->id?>">
    <?= ($widget->showTitle ? Html::tag("p", Yii::t('tostatus','Status history'), $widget->headerOptions) : null) ?>

    <?= Html::beginTag("div", $widget->itemsOptions)?>
    <?=
    ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' =>
            function (\andmemasin\myabstract\HasStatusModel $model) use ($formatter) {
                if(!empty($model->statusModel)) {
                    $user = $model->getUserCreated();
                    $title = (empty($model->statusModel->description) ? $model->statusModel->label : $model->statusModel->description);
                    $tag = Html::tag("span", $model->statusModel->label . ' ('. Html::encode($user->username).')', ['data-toggle' => "tooltip", 'title' => $title]);
                    return $formatter->asDatetime($model->timeCreated)
                        . ' - '
                        . $tag;

                }
                return $model->status;
            },
    ]);
    ?>
    <?= Html::endTag("div")?>

</div>