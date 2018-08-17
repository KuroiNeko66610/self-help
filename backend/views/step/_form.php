<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \common\models\Step;
use yii\bootstrap\Alert;
use dosamigos\ckeditor\CKEditor;

if (isset($post))
    $model->post_id = $post;
/* @var $this yii\web\View */
/* @var $model common\models\Step */
/* @var $form yii\widgets\ActiveForm */
?>


<?php
/* Обновление слайдов в карусели после успешного сохранения шага
    карусель перезагружается полностью при изменении порядка и при добавлении новой картинки
*/
if (isset($success)) {
    $script = <<< JS
 updateCarousel();

function reloadCarousel() {    
        $.post( "/admin/step/ajax-load-carousel", {'post_id': $model->post_id}, function( data ) {            
            $( "#step-crousel" ).html( data );
            
            var step_id = $( "#step-id" ).val();
            var item = $('#step-carousel').find("[step='" + step_id + "']");
            $('#step-carousel').carousel(item.index());         
        });              
      
}

function updateCarousel() {    
    var new_image = "$model->image";
    var id = "$model->id";    
    var image = $('#step-carousel').find("[step='" + id + "'] img");
   
    /* Был добавлен новый шаг*/
    if(typeof image.attr('src') === 'undefined'){        
      reloadCarousel()        
    }else{       
        /*Было загружено новой изображение*/
    if(image.attr('src') != "/uploads/post/" + new_image)
         image.attr('src',"/uploads/post/" + new_image)
    }
} 
JS;
    $this->registerJs($script);

    $reload = '';
    /* Перезагрузка карусели при изменении порядка картинки*/
    if ($saved === 2) {
        $reload = <<< JS
            reloadCarousel();
JS;
    }
    $this->registerJs($reload);
}
?>


<?php $form = ActiveForm::begin(['action' => '/admin/step/ajax-save-form', 'options' => ['class' => 'formstep', 'id' => 'step_form', 'data-pjax' => true]]); ?>

<div class="box-body table-responsive">
    <?php if (isset($success)): ?>
        <?= Alert::widget([
            'options' => [
                'class' => 'alert-success',
            ],
            'body' => $success,
        ]); ?>
    <?php endif; ?>

    <?= Alert::widget([
        'options' => [
            'id' => 'new-message',
            'style' => (empty($model->id)) ? 'display:block' : 'display:none',
            'class' => 'alert-info',
        ],
        'body' => 'Введите данные и нажмите сохранить',
    ]); ?>


    <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'post_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'order')->dropDownList($model::getOrderList($model->post_id), array()) ?>

    <?= $form->field($model, 'image_file')->fileInput([])->label(false) ?>

    <?= $form->field($model, 'text')->widget(CKEditor::className(), [
        'options' => ['rows' => 6, 'id' => 'step-text'],
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
    <?= Html::Button('Новый шаг', ['class' => 'btn btn-primary btn-flat', 'onclick' => 'resetForm()']) ?>
    <?= Html::Button('Удалить', ['class' => 'btn btn-danger btn-flat', 'onclick' => 'deleteStep()']) ?>

</div>


<?php ActiveForm::end(); ?>
