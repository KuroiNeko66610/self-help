<?php
/**
 * Created by PhpStorm.
 * User: Neko
 * Date: 26.11.2017
 * Time: 18:04
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;
?>
<h3>Смена пароля</h3>

<div class="user-form box box-primary">
    <?php if ($success): ?>
        <div style="color: green;text-align: center"><h4><?='Пароль успешно изменен!'?></h4></div>
    <?php endif; ?>

    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">
        <?= $form->field($model, 'currentPassword')->passwordInput() ?>
        <?= $form->field($model, 'newPassword')->passwordInput() ?>
        <?= $form->field($model, 'newPasswordRepeat')->passwordInput() ?>
    </div>
    <div class="box-footer">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
