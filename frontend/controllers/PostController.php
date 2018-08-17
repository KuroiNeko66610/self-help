<?php

namespace frontend\controllers;

use Yii;
use common\models\Category;
use common\models\Post;
use common\models\Step;
use common\models\search\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class PostController extends \yii\web\Controller
{
    public function actionView($id = 0)
    {
        $post = Post::findOne($id);
        $breadcrumbs = [];
        if(empty($post)) {
            throw new NotFoundHttpException('Такой страницы не существует');
        }

        if(!empty($post->category_id)) {
            $category = Category::findOne(['id' => $post->category_id]);
            $breadcrumbs = $category->getBreadcrumbsArray(1);
        }


        $steps = Step::find()->where(['post_id' => $id])->orderBy('order')->asArray()->all();

        return $this->render('view', [
            'breadcrumbs' => $breadcrumbs,
            'post' => $post,
            'steps' => $steps
        ]);

    }
}
