<?php
use \yii\helpers\Html;
$this->params['breadcrumbs'] = $breadcrumbs;
?>

<?php if(!empty($children_category)):?>
    <div class="row">
        <div class="col-md-12">
            <h4> Найдены категории : </h4>
            <?php foreach ($children_category as $category):?>
                    <?= Html::a($category['name'], ['/category/'.$category['id']], ['class'=>'btn btn-success', 'style' => 'margin: 4px']) ?>
            <?php endforeach;?>
        </div>
    </div>
<?php endif;?>
<?php ?>

<?php if(!empty($posts)):?>
    <div class="row" style="margin-top: 20px">
        <div class="col-md-12">
            <hr>
            <h4> Найдены инструкции : </h4>
            <?php foreach ($posts as $post):?>
                    <div class="post-item">
                        <?= Html::a($post['title'], ['/post/'.$post['id']], ['class'=>'',]) ?>

                        <p><?=$post['description']?></p>
                        <?= Html::a('Перейти к инструкции', ['/post/'.$post['id']], ['class'=>' btn btn-success post-button']) ?>

                    </div>

            <?php endforeach;?>
        </div>
    </div>
<?php endif;?>
