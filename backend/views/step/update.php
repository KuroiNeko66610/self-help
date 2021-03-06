<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Step */

$this->title = 'Update Step: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Steps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="step-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
