<?php
namespace backend\controllers;

use common\models\PasswordChangeForm;
use common\models\User;
use common\models\Post;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\data\ActiveDataProvider;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'rbac'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'change-password'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        //$favorites

        $favorites = explode(',',Yii::$app->user->identity->favorites);
        $query = Post::find()->where(['id' => $favorites]);
        $fav_provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);


        $query = Post::find()->where(['user_id' => Yii::$app->user->identity->id]);
        $autor_provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $query = Post::find()->orderBy('created_at','DESC')->limit(10);
        $last_provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);

        return $this->render('index', [
            'fav_provider' => $fav_provider,
            'author' => $autor_provider,
            'last' => $last_provider
        ]);



    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    public function actionChangePassword(){

        $user = User::findOne(Yii::$app->user->identity->id);
        $model = new PasswordChangeForm($user);
        $success = false;

        if ($model->load(Yii::$app->request->post()) && $model->changePassword()) {
            $success = true;
        }

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('change-password', [
                'model' => $model,
                'success' => $success
            ]);
        }

    }

    public function actionRbac(){
        /*
        $role = Yii::$app->authManager->createRole('admin');
        $role->description = 'Администратор';
        Yii::$app->authManager->add($role);

        $role = Yii::$app->authManager->createRole('moderator');
        $role->description = 'Модератор';
        Yii::$app->authManager->add($role);

        $role = Yii::$app->authManager->createRole('author');
        $role->description = 'Автор';
        Yii::$app->authManager->add($role);

        */

       // $role = Yii::$app->authManager->getRole('admin');
       // $permit = Yii::$app->authManager->getRole('moderator');
        //Yii::$app->authManager->addChild($role, $permit);
/*

        $authManager = Yii::$app->authManager;
        $authorRule = new \common\rules\AuthorRule;
        $authManager->add($authorRule);

        $permit = Yii::$app->authManager->createPermission('UpdataOwnPost');
        $permit->description = 'Право на редактирование собственного поста';
        $permit->ruleName = $authorRule->name;
        Yii::$app->authManager->add($permit);
/*

        $permit = Yii::$app->authManager->getPermission('UpdataOwnPost');
        Yii::$app->authManager->assign($permit, 2);
*/
        echo "done!";
    }
}
