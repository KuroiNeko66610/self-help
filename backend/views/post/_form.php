<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\widgets\Pjax;
use dosamigos\ckeditor\CKEditor;
use common\models\Category;
use kartik\tree\TreeViewInput;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<?php Pjax::begin(['id' => 'post_form', 'enablePushState' => false])?>
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>
    <div class="box-body table-responsive">
        <div class="form-group field-post-title">
            <label class="control-label" for="post-category_id">Категория</label>
        <?php

            echo TreeViewInput::widget([
                // single query fetch to render the tree
                'query'             => Category::find()->addOrderBy('root, lft'),
                'headingOptions'    => ['label' => 'Категория'],
                'name'              => 'Post[category_id]',    // input name
                'value'             => $model->category_id,         // values selected (comma separated for multiple select)
                'asDropdown'        => true,            // will render the tree input widget as a dropdown.
                'multiple'          => false,            // set to false if you do not need multiple selection
                'fontAwesome'       => true,            // render font awesome icons
                'rootOptions'       => [
                    'label' => '<i class="fa fa-tree"></i>',
                    'class'=>'text-success'
                ],                                      // custom root label
                //'options'         => ['disabled' => true],
            ]);

            ?>
        </div>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'visible')->checkbox(['label' => 'Опубликовать на сайте', 'options' => ['class' => 'minimal']]) ?>


        <?= $form->field($model, 'description')->widget(CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'custom',
            'clientOptions' => [
                'extraPlugins' => 'colorbutton',
                'toolbarGroups' => [
                    ['name' => 'undo'],
                    ['name' => 'basicstyles', 'groups' => ['basicstyles', 'cleanup']],
                    ['name' => 'colors'],
                    ['name' => 'colorbutton']
                ],
            ],

        ]) ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>

<?php Pjax::end()?>
