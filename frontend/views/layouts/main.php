<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use common\assets\CommonAsset;


AppAsset::register($this);
CommonAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="container">
<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation" style="position: relative">
    <div class="container topnav">
        <div class="navbar-header">

        </div>
        <div class="collapse navbar-collapse">
                <?=Html::a(Html::img('/images/logo.png'),\yii\helpers\Url::home()) ;?>
            <span class="navbar-title">Портал инструкций МЦТП</span>
            <ul class="nav navbar-nav navbar-right">

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
</div>
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
                <div class="content">
                    <?= $content ?>
                </div>
            </div>
        </div>

    </div>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

            </div>
        </div>
    </div>
</footer>

</body>

<?php $this->endBody() ?>
</html>
<?php $this->endPage() ?>
