<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">--></span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- Messages: style can be found in dropdown.less-->

                <!-- Tasks: style can be found in dropdown.less -->

                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <?= Html::a(Yii::$app->user->identity->username. ' (выход)', Url::to(['site/logout']), ['data-method' => 'POST']) ?>
                </li>
                <li>
                    <?= Html::a('<i class="fa fa-gears "></i>', ['site/change-password'], ['id' => 'change-password'])?>

                </li>

            </ul>
        </div>
    </nav>
</header>

<?php
\conquer\modal\ModalForm::widget([
    'selector' => '#change-password',
]);
?>

