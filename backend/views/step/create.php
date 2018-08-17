<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Step */

$this->title = 'Create Step';
$this->params['breadcrumbs'][] = ['label' => 'Steps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="step-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
