<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\News;
use frontend\models\Article;
use frontend\models\Gallery;
use frontend\models\Vdo;
use frontend\models\Company;
use frontend\models\Work;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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

    public function actionIndex()
    {
        // Hot News
        $hot = News::find()->where([
            'active' => 1,
            'news_hot' => 1,
            'lan_id' => Yii::$app->languages->id,
            'publish' => 1
        ])->orderBy([
            'create' => SORT_DESC,
            'news_id' => SORT_DESC
        ])->limit(5)->all();

        // News
        $news = News::find()->where([
            'active' => 1,
            'lan_id' => Yii::$app->languages->id,
			'news_price' => 0,
            'publish' => 1
        ])->orderBy([
            'create' => SORT_DESC,
            'news_id' => SORT_DESC
        ])->limit(8)->all();
		
		
		// Price
        $price = News::find()->where([
            'active' => 1,
            'lan_id' => Yii::$app->languages->id,
			'news_price' => 1,
            'publish' => 1
        ])->orderBy([
            'create' => SORT_DESC,
            'news_id' => SORT_DESC
        ])->limit(8)->all();

        // Article
        $article = Article::find()->where([
            'active' => 1,
            'lan_id' => Yii::$app->languages->id,
            'publish' => 1
        ])->orderBy([
            'create' => SORT_DESC,
            'art_id' => SORT_DESC
        ])->limit(8)->all();

        // Gallery
        $gallery = Gallery::find()->where([
            'active' => 1,
            'lan_id' => Yii::$app->languages->id,
            'publish' => 1
        ])->orderBy([
            'create' => SORT_DESC,
            'gall_id' => SORT_DESC
        ])->limit(6)->all();

        // Video
        $video = Vdo::find()->where([
            'active' => 1,
            'lan_id' => Yii::$app->languages->id,
            'publish' => 1
        ])->orderBy([
            'create' => SORT_DESC,
            'vdo_id' => SORT_DESC
        ])->limit(6)->all();

        // Company
        $company = Company::find()->where([
            'active' => 1,
            'lan_id' => Yii::$app->languages->id,
            'publish' => 1
        ])->orderBy([
            'create' => SORT_DESC,
            'com_id' => SORT_DESC
        ])->limit(10)->all();

        // Work
        $work = Work::find()->where([
            'active' => 1,
            'lan_id' => Yii::$app->languages->id,
            'publish' => 1
        ])->orderBy([
            'create' => SORT_DESC,
            'work_id' => SORT_DESC
        ])->limit(5)->all();
		
        return $this->render('index',[
            'news' => $news,
            'article' => $article,
            'gallery' => $gallery,
            'video' => $video,
            'company' => $company,
            'work' => $work,
            'hot' => $hot,
			'price' => $price,
        ]);
    }

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
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionChangelg($id = null){
        Yii::$app->session['lang'] = $id;

        // return $this->redirect(Yii::$app->request->referrer);
        return $this->redirect(Yii::$app->homeUrl);

    }
}
