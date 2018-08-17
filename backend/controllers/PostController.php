<?php

namespace backend\controllers;

use common\models\Step;
use common\models\User;
use Yii;
use common\models\Post;
use common\models\search\PostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['*'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    // everything else is denied
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
       // $model = Post::find()->where(['post.id' => $id])->joinWith('steps as st')->orderBy(['st.order' => 'DESC'])->one();

        $model = $this->findModel($id);
        $steps = Step::find()->where(['post_id' => $id])->orderBy('order')->all();

        return $this->render('view', [
            'model' => $model,
            'steps' => $steps
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if(! Yii::$app->user->can('UpdatePost', ['post' => $model]))
            throw new ForbiddenHttpException('У вас недостаточно прав для выполнения указанного действия');

        $steps = Step::find()->where(['post_id' => $id])->orderBy('order')->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->render('_form', [
                'model' => $model,
            ]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'steps' => $steps
            ]);
        }
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if(! Yii::$app->user->can('UpdatePost', ['post' => $model]))
            throw new ForbiddenHttpException('У вас недостаточно прав для выполнения указанного действия');

        $model->delete();

        return $this->redirect(['index']);
    }

    public function actionAddToFavorites(){
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $data['post_id'] = intval($data['post_id']);
            $user = User::findOne(Yii::$app->user->identity->id);

            if($data['operation'] == 'add'){
                $favorites =  $user->favorites;
                $favorites .= ($favorites == '')? $data['post_id']: ','.$data['post_id'];
            }else{
                $favorites = explode(',',$user->favorites);
                $favorites = array_unique($favorites);
                $favorites = array_diff($favorites, array($data['post_id']));
                $favorites = implode(',',$favorites);
            }

            $user->favorites = $favorites;
            if($user->update('false', ['favorites']))
                return true;

            return false;
        }
    }
    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
