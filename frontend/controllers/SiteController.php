<?php
namespace frontend\controllers;

use Yii;

use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User;
use app\models\Log;

use frontend\models\LogSearch;
use app\models\BusDetails;
use yii\db\Query;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\ChangePassForm;
use yii\data\ActiveDataProvider;
use app\models\LogOut;

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
                'only' => ['index','changepassword'],
                'rules' => [
                    [
                        'actions' => [''],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                     [
                        'actions' => ['index','changepassword'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    
                ],
                'denyCallback' => function ($rule, $action) {
              return $this->redirect('login');
    }
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {                
        if(Yii::$app->session->get('usr_role') != '')
        {
            $model = LogOut::find();     
            $modelData = new ActiveDataProvider([
            'query' => $model,]);
            $model-> where(['and',['log_date' =>date("Y-m-d")]]);
            $model->groupBy(['rf_id']);
            $model->all();
        
        $dd = Log::find();     
        $dataProvide = new ActiveDataProvider([
            'query' => $dd,]);
        $dd-> where(['and',['log_date' =>date("Y-m-d")]]);
        $dd->groupBy(['rf_id']);
        $dd->all();
        
       $log = BusDetails::find()->all();
        return $this->render('dashboard', [           
            'dataProvide' => $dataProvide,
            'log' => $log,
            'modelData' =>$modelData,           
        ]); 
        }
        else{
         return $this->redirect(Yii::$app->request->baseUrl.'/site/login');   
        }       
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */

    public function actionLogin()
    {


        $model = new LoginForm();        
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $log = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
            Yii::$app->session->set('usr_role',$log->role);
            Yii::$app->session->set('usr_name',$log->username);
            return $this->redirect(Yii::$app->request->baseUrl.'/site/index');

        } else {
            $this->layout = 'login';
            return $this->render('userlog', [
                'model' => $model,
            ]);
        }
   
   
   
}
    // public function actionLogin()
    // {     
        

    //     if (!Yii::$app->user->isGuest) {
    //         return $this->goHome();
    //     }

    //     $model = new LoginForm();
        
    //     if ($model->load(Yii::$app->request->post()) && $model->login()) {
    //         $log = User::find()->where(['username' => Yii::$app->user->identity->username])->one();

    //         Yii::$app->session->set('usr_role',$log->role);

    //         return $this->goBack();
    //     } else {
    //         return $this->render('login', [
    //             'model' => $model,
    //         ]);
    //     }
    // }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {   Yii::$app->session->destroy();
        Yii::$app->user->logout();
        
        return $this->redirect('login');
        
    }
        
    /**
     * Displays contact page.
     *
     * @return mixed
     */
    // public function actionContact()
    // {
    //     $model = new ContactForm();
    //     if ($model->load(Yii::$app->request->post()) && $model->validate()) {
    //         if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
    //             Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
    //         } else {
    //             Yii::$app->session->setFlash('error', 'There was an error sending your message.');
    //         }

    //         return $this->refresh();
    //     } else {
    //         return $this->render('contact', [
    //             'model' => $model,
    //         ]);
    //     }
    // }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    // public function actionAbout()
    // {
    //     return $this->render('about');
    // }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()  {  
        if(Yii::$app->session->get('usr_role') != ''){
        $log = User::find()->where(['username' => Yii::$app->user->identity->username])->one();           
           if($log->role == 'Admin' || $log->role == 'Superadmin') 
            {      
                $model = new SignupForm();
                if ($model->load(Yii::$app->request->post())) {
                    if ($user = $model->signup()) {
                        if (Yii::$app->getUser()->login($user)) {
                            return $this->redirect(Yii::$app->request->baseUrl.'/user/index');
                        }
                    }
                }

                return $this->render('signup', [
                    'model' => $model,
                ]);
            }
            else {
                return $this->redirect(Yii::$app->request->baseUrl.'/site/error'); 
            }
        }
        else{
        return $this->redirect(Yii::$app->request->baseUrl.'/site/login');
        }
    }
    

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    // public function actionRequestPasswordReset()
    // {
    //     $model = new PasswordResetRequestForm();
    //     if ($model->load(Yii::$app->request->post()) && $model->validate()) {
    //         if ($model->sendEmail()) {
    //             Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

    //             return $this->goHome();
    //         } else {
    //             Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
    //         }
    //     }

    //     return $this->render('requestPasswordResetToken', [
    //         'model' => $model,
    //     ]);
    // }

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


    public function actionChangepassword() {
        if(Yii::$app->session->get('usr_role') != ''){
        $log = User::find()->where(['username' => Yii::$app->user->identity->username])->one();      
        if($log->role == 'Admin' || $log->role == 'Superadmin') 
        {  
            $model = new ChangePassForm;
            $modeluser = User::find()->where([
                'username'=>Yii::$app->user->identity->username
            ])->one();

            if($model->load(Yii::$app->request->post())){
                if($model->validate()){
                    try{
                        $modeluser->password = $_POST['PasswordForm']['newpass'];
                        if($modeluser->save()){
                            Yii::$app->getSession()->setFlash(
                                'success','Password changed'
                            );
                            return $this->redirect(['index']);
                        }else{
                            Yii::$app->getSession()->setFlash(
                                'error','Password not changed'
                            );
                            return $this->redirect(['index']);
                        }
                    }catch(Exception $e){
                        Yii::$app->getSession()->setFlash(
                            'error',"{$e->getMessage()}"
                        );
                        return $this->render('changepassword',[
                            'model'=>$model
                        ]);
                    }
                }else{
                    return $this->render('changepassword',[
                        'model'=>$model
                    ]);
                }
            }else{
                return $this->render('changepassword',[
                    'model'=>$model
                ]);
            }
        }
        else
        {
            $this->layout = 'login';
            return $this->render('userlog', [ 'model' => $model,]);

        }
    }

    else{
        return $this->redirect(Yii::$app->request->baseUrl.'/site/login');
    }
}
    


}
