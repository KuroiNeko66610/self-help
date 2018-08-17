<?php

namespace backend\controllers;

use common\models\Post;
use Yii;
use common\models\Step;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * StepController implements the CRUD actions for Step model.
 */
class StepController extends Controller
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
     * Finds the Step model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Step the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Step::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAjaxDeleteStep()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();

            $step = Step::findOne($data['step']);
            if (!empty($step)) {
                if (is_file(Yii::getAlias('@uploads') . '/post/' . $step['image']))
                    unlink(Yii::getAlias('@uploads') . '/post/' . $step['image']);
                $step->delete();
                return $step->id;
            }

        }
    }

    /**
     * @return string
     */
    public function actionAjaxLoadForm()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();

            $step = Step::findOne($data['step']);
            if (empty($step)) {
                $step = new Step();
                $step->post_id = $data['post_id'];
            }

            return $this->renderAjax('_form', ['model' => $step]);
        }
    }

    public function actionAjaxLoadCarousel()
    {
        $post_id = Yii::$app->request->post('post_id');
        $steps = Step::find()->where(['post_id' => $post_id])->orderBy('order')->all();

        return $this->renderAjax('_carousel', ['steps' => $steps]);
    }

    public function actionAjaxSaveForm()
    {

        $data = Yii::$app->request->post('Step');

        $post = Post::findOne($data['post_id']);
        if(! Yii::$app->user->can('UpdatePost', ['post' => $post]))
            throw new ForbiddenHttpException('У вас недостаточно прав для выполнения указанного действия');

        if ($data['id'] != null) {
            $model = $this->findModel($data['id']);
        }
        else
            $model = new Step();

        $model->load(Yii::$app->request->post());

        $model->image_file = UploadedFile::getInstance($model, 'image_file');


        if ($model->validate()) {
            $saved = $model->saveStep();
            if ($saved)
                return $this->renderAjax('_form', ['model' => $model, 'success' => "Данные успешно сохранены", 'saved' => $saved]);
        }

        return $this->renderAjax('_form', ['model' => $model, 'errors' => "Произошла ошибка"]);

    }
}
