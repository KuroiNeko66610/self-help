<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\components\SaHtml;
use common\models\Category;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\Post */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Инструкции';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="post-index box box-primary">
    <?php Pjax::begin(); ?>
    <div class="box-header with-border">
        <?= Html::a('Новая инструкция', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",

            'columns' => [
                //['class' => 'yii\grid\ActionColumn'],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {delete} {copyLink} {addToFavorites}', // the default buttons + your custom button
                    'visibleButtons' => [
                        'update' => function ($model, $key, $index) {
                            return Yii::$app->user->can('UpdatePost',['post' => $model]);
                        },
                        'delete' => function ($model, $key, $index) {
                            return Yii::$app->user->can('UpdatePost',['post' => $model]);
                        },
                        //'delete' => Yii::$app->user->can('UpdatePost',['post' => $model]),
                    ],
                    'buttons' => [
                        //'update' => Yii::$app->user->can('UpdatePost',['post' => $model]),
                        'addToFavorites' => function ($url, $model, $key) {     // render your custom button
                            return Html::a('', 'javascript:void(0)', ['onclick' => 'addToFavorites($(this),' . $model->id . ')', 'class' => 'fa '. SaHtml::isFavorite($model->id), 'title' => 'Добавить в избранное']);
                        },
                        'copyLink' => function ($url, $model, $key) {     // render your custom button
                            return Html::a('', 'javascript:copyToClipboard("' . Yii::$app->urlManagerFrontend->createUrl('post/view') . '/' . $model->id . '")', ['class' => 'fa fa-copy ', 'title' => 'Копировать Url']);
                        }
                    ]
                ],
                [
                    'attribute' => 'category_id',
                    'value' => 'category.name',
                ],
                [
                    'attribute' => 'user_id',
                    'value' => 'user.username',
                ],
                [
                    'attribute' => 'title',
                    'value' => function ($model) {
                        return SaHtml::TruncateText($model->title, 40);
                    },
                ],
                [
                    'attribute' => 'description',
                    'value' => function ($model) {
                        return SaHtml::TruncateText($model->description, 30);
                    },
                ],
                'visible',
                [
                    'label' => 'Просмотры',
                    'attribute' => 'view_count',
                ],
                [
                    'label' => 'Помогло / Нет',
                    'attribute' => 'help_count',
                    'value' => function ($model) {
                        return $model->help_count . ' / ' . $model->useless_count;
                    },
                ],
                'created_at:date',
                // 'updated_at',
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
