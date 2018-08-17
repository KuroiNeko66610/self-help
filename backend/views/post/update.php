<?php

use yii\helpers\Html;
use common\models\Step;
use \yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Инструкции', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row" style="margin-bottom: 15px">
    <div class="col-md-12">
        <?= Html::a('Копировать Url', 'javascript:copyToClipboard("'.Yii::$app->urlManagerFrontend->createUrl('post/view').'/'.$model->id.'")' , ['class' => 'btn btn-warning btn-flat']) ?>
    <?= Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-primary btn-flat']) ?>
    <?= Html::a('На сайте', Yii::$app->urlManagerFrontend->createUrl('post/view').'/'.$model->id, ['target' => '_blank','class' => 'btn btn-success btn-flat']) ?>
    <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger btn-flat',
        'data' => [
            'confirm' => 'Вы уверены, что хотите удалить инструкцию?',
            'method' => 'post',
        ],
    ]) ?>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
    <div class="box box-default collapsed-box">
        <div class="box-header with-border">
            <h3 class="box-title">Редактирование основной информации</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <?=$this->render('_form', ['model' => $model])?>
        </div>
        <!-- /.box-body -->
    </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Слайды</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" id="caro">
                <?php Pjax::begin(['id' => 'step-crousel', 'enablePushState' => false])?>
                <?=$this->render('/step/_carousel', ['steps' => $steps])?>
                <?php Pjax::end()?>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>

    <?php
        if(empty($steps))
            $step = new Step();
        else
            $step = $steps[0];
    ?>
    <div class="col-md-6">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Редактирование</h3>
            </div>
            <?php Pjax::begin(['id' => 'step-form', 'enablePushState' => false]); ?>
            <div class="box-body" id="">
                <?=$this->render('/step/_form', ['post' => $model->id,'model' => $step]); ?>
            </div>
            <?php Pjax::end(); ?>
        </div>

    </div>

</div>
