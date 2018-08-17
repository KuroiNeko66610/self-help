<?php
use \yii\helpers\Html;
$this->params['breadcrumbs'] = $breadcrumbs;
?>
<h3><?=$post->title ?></h3>

<div id="rootwizard">
    <div class="navbar" >
        <div class="navbar-inner">
            <div class="container">
                <ul >
                    <?php $i = 1; foreach ($steps as $step):?>
                        <li><a href="#tab<?=$i?>" data-toggle="tab" style="display: none"><?=$i++?></a></li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
    </div>

    <div class="tab-content">
        <?php $i = 1; foreach ($steps as $step):?>
            <div class="tab-pane" id="tab<?=$i++?>">
                <div class="row">
                    <div class="col-sm-12">
                        <div align="center" style="margin-bottom: 30px">
                            <?=$step['text']?>
                        </div>
                        <div align="center" >
                           <?=\yii\helpers\Html::img('/uploads/post/'.$step['image'],['style' => 'width:80%'])?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
        <div id="bar" class="progress" style="margin-top: 20px">
            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
        </div>
    </div>
    <div class="wizard-pager">
        <ul class="pager wizard">
            <li class="previous"><a href="javascript:void(0)"><?=Html::img('/images/left.png')?></a></li>
            <li class="next"><a href="javascript:void(0)"><?=Html::img('/images/right.png')?></a></li>
        </ul>
    </div>
</div>
