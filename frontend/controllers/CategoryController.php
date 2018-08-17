<?php

namespace frontend\controllers;

use common\models\Post;
use Yii;
use common\models\Category;
use common\models\search\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class CategoryController extends \yii\web\Controller
{
    public function actionView($id = 0)
    {


        //$category = Category::getTree(Category::find()->roots()->addOrderBy('root','lft')->andWhere(['active' => true]));
        if($id === 0){
            $current_category = new Category();
            $children_category = Category::find()->roots()->all();
            $breadcrumbs = $current_category->getBreadcrumbsArray();
        }
        else {
            $current_category = Category::findOne(['id' => $id]);
            $children_category = $current_category->children(1)->asArray()->all();
            $breadcrumbs = $current_category->getBreadcrumbsArray();
        }

        $posts = Post::find()->where(['category_id' => $id])->asArray()->all();

        /* Если нет суб категорий и инструкция только одна то переход на инструкцию*/
        if(empty($children_category) and count($posts) === 1){
            return $this->redirect('/post/view/'.$posts[0]['id']);
        }

        return $this->render('view', [
            'posts' => $posts,
            'breadcrumbs' => $breadcrumbs,
            'category' => $current_category,
            'children_category' => $children_category
        ]);

    }

}
