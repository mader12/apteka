<?php

namespace app\controllers;

use app\models\DrugsSku;
use app\models\forms\LoginForm;
use app\models\forms\RegistrationForm;
use app\models\orders\BasketOrder;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'login', 'registration'],
                'denyCallback' => function ($rule, $action) {
                    throw new \Exception('У вас нет доступа к этой странице');
                },
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['login', 'registration'],
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                    'send' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
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
        $drugs = DrugsSku::find()
            ->with('drug')
            ->with('dosage')
            ->with('form')
            ->with('pharma')
            ->with('indicators');

        $dataProvider = new ActiveDataProvider([
            'query' => $drugs,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        $this->view->title = 'Список товаров';

        return $this->render('index', ['listDataProvider' => $dataProvider]);
    }

    /**
     * SEND order.
     *
     * @return string
     */
    public function actionSend()
    {

        $basket = BasketOrder::find()->where(['session_id' => \Yii::$app->session->getId()])
            ->with('drugsSku')
            ->with('order')
            ->with('form')
            ->with('drug')
            ->with('pharma');

        $dataProvider = new ActiveDataProvider([
            'query' => $basket,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);
        
        return $this->render('send_order', ['dataProvider' => $dataProvider]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                return $this->goHome();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * registration action.
     *
     * @return Response|string
     */
    public function actionRegistration()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goBack();
        }
        Yii::$app->response->cookies->add(new \yii\web\Cookie([
            'name' => 'language',
            'value' => 'ru-RU',
        ]));
        $model = new RegistrationForm();
        if ($model->load(Yii::$app->request->post()) && $model->registration()) {

            return $this->goHome();
        }

        return $this->render('registration', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays basket page.
     *
     * @return string
     */
    public function actionBasket()
    {
        $basket = BasketOrder::find()->where(['session_id' => \Yii::$app->session->getId()])
            ->with('drugsSku')
            ->with('order')
            ->with('form')
            ->with('drug')
            ->with('pharma');

        $dataProvider = new ActiveDataProvider([
            'query' => $basket,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        return $this->render('basket', ['dataProvider' => $dataProvider]);
    }
}
