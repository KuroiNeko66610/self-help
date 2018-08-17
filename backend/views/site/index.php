<?php
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use yii\helpers\Html;
use common\components\SaHtml;
/* @var $this yii\web\View */

$this->title = 'Стартовая страница';
?>
<div class="site-index">

    <div class="row">
        <div class="col-md-6">
            <?php \insolita\wgadminlte\CollapseBox::begin([
                'type'=>\insolita\wgadminlte\LteConst::TYPE_SUCCESS,
                'collapseRemember' => false,
                'collapseDefault' => false,
                'isSolid'=>true,
                'boxTools'=>'
<a href="'.Url::to(['post/create']).'">
<button class="btn btn-default btn-xs create_button" ><i class="fa fa-plus-circle"></i> Новая</button></a>',
                'tooltip'=>'Избранное',
                'title'=>'Избранное',
            ])?>
            <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $fav_provider,
                'layout' => "{items}\n{pager}",

                'columns' => [
                    //['class' => 'yii\grid\ActionColumn'],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {addToFavorites} {copyLink} ',
                        'buttons' => [
                            'addToFavorites' => function ($url, $model, $key) {     // render your custom button
                                return Html::a('', 'javascript:void(0)', ['onclick' => 'addToFavorites($(this),' . $model->id . ')', 'class' => "fa ". SaHtml::isFavorite($model->id), 'title' => 'Добавить в избранное']);
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
                ],
            ]); ?>
            <?php Pjax::end(); ?>
            <?php \insolita\wgadminlte\CollapseBox::end()?>

        </div>

        <div class="col-md-6">
            <?php \insolita\wgadminlte\CollapseBox::begin([
                'type'=>\insolita\wgadminlte\LteConst::TYPE_PRIMARY,
                'collapseRemember' => false,
                'collapseDefault' => false,
                'isSolid'=>true,
                'boxTools'=>'
<a href="'.Url::to(['post/create']).'">
<button class="btn btn-default btn-xs create_button" ><i class="fa fa-plus-circle"></i> Новая</button></a>',
                'tooltip'=>'Собственные',
                'title'=>'Собственные',
            ])?>
            <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $author,
                'layout' => "{items}\n{pager}",

                'columns' => [
                    //['class' => 'yii\grid\ActionColumn'],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update} {delete} {addToFavorites} {copyLink} ',
                        'buttons' => [
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
                ],
            ]); ?>
            <?php Pjax::end(); ?>
            <?php \insolita\wgadminlte\CollapseBox::end()?>

        </div>

        <div class="col-md-12">
            <?php \insolita\wgadminlte\CollapseBox::begin([
                'type'=>\insolita\wgadminlte\LteConst::TYPE_WARNING,
                'collapseRemember' => false,
                'collapseDefault' => false,
                'isSolid'=>true,
                'boxTools'=>'
<a href="'.Url::to(['post/create']).'">
<button class="btn btn-default btn-xs create_button" ><i class="fa fa-plus-circle"></i> Новая</button></a>',
                'tooltip'=>'Последние ',
                'title'=>'Последние',
            ])?>
            <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $last,
                'layout' => "{items}\n{pager}",

                'columns' => [
                    //['class' => 'yii\grid\ActionColumn'],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {addToFavorites} {copyLink} ',
                        'buttons' => [
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
                ],
            ]); ?>
            <?php Pjax::end(); ?>
            <?php \insolita\wgadminlte\CollapseBox::end()?>

        </div>

    </div>




</div>

