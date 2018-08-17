<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use \yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Инструкции', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
<div class="post-view box box-primary">
    <div class="box-header">
        <?= Html::a('Копировать Url', 'javascript:copyToClipboard("'.Yii::$app->urlManagerFrontend->createUrl('post/view').'/'.$model->id.'")' , ['class' => 'btn btn-warning btn-flat']) ?>
        <?= Html::a('На сайте', Yii::$app->urlManagerFrontend->createUrl('post/view').'/'.$model->id, ['target' => '_blank','class' => 'btn btn-success btn-flat']) ?>
        <?php if(Yii::$app->user->can('UpdatePost', ['post' => $model])):?>
            <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-flat']) ?>
            <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger btn-flat',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите удалить инструкцию?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif;?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                [
                    'attribute' => 'category_id',
                    'value' => $model->category->name,
                ],
                [
                    'attribute' => 'user_id',
                    'value' => $model->user->username,
                ],
                'title:html',
                'description:html',
                'visible',
                'view_count',
                'help_count',
                'useless_count',
                'created_at:date',
                'updated_at:datetime',
            ],
        ]) ?>
    </div>
</div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Просмотр</h3>
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

</div>