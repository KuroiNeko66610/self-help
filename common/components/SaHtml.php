<?php
namespace common\components;
use Yii;

trait SaHtml
{

    public static function TruncateText($text, $max_len)
    {
        $text = strip_tags($text);
        $len = mb_strlen($text, 'UTF-8');

        if ($len <= $max_len)
            return $text;
        else
            return mb_substr($text, 0, $max_len - 1, 'UTF-8') . '...';
    }

    public static function isFavorite($post_id){
        $favorites = explode(',',Yii::$app->user->identity->favorites);
        if(sizeof($favorites) > 0 && in_array($post_id,$favorites))
            return 'fa-heart';
        else return 'fa-heart-o';


    }

}






