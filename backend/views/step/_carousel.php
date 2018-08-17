<?php
use yii\bootstrap\Carousel;
?>

<?php if(!empty($steps)):?>

<?php
$i = 0;
foreach ($steps as $step){
    $items[$i]['content'] = '<img src="/uploads/post/'.$step->image.'"/>';
    $items[$i]['options'] =  ['step' => $step->id, 'order' => $step->order];
    $i++;
}

?>
    <?php
    /* После перезагрузки карусели аяксом слетает обработчик событий, регистрируем его заново*/
    $script = <<< JS
    $(document).ready(function() {
            $('#step-carousel').on('slid.bs.carousel', function (event) {
                var active = $(event.target).find('.carousel-inner > .item.active');
                var next = $(event.relatedTarget);
                loadForm(next.attr('step'));
            });
        });
JS;

    $this->registerJs($script, yii\web\View::POS_READY);
    ?>

<?php echo Carousel::widget ( [
    'items' =>  $items,
     'showIndicators' => true,
    'options' => ['class' => 'carousel slide', 'id' => 'step-carousel', 'data-interval' => 'false'],
    'controls' => [
        '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>',
        '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>'
    ]
]);
?>

<?php else: ?>
    <p>Ни одного слайда еще не добавлено</p>
<?php endif; ?>

