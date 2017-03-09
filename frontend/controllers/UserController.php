<?php

namespace frontend\controllers;

use Yii;
use app\models\User;
use frontend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
     public function behaviors()
    {
         return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','create','delete','update','view'],
                'rules' => [
                    [
                        'actions' => [''],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                     [
                        'actions' => ['index','create','view','delete','update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    
                ],
            ],
           
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {       
        if(Yii::$app->session->get('usr_role') != ''){
            $log = User::find()->where(['username' => Yii::$app->user->identity->username])->one(); 
    
            if(Yii::$app->session->get('usr_role')  == 'Admin' || Yii::$app->session->get('usr_role')  == 'Superadmin') 
            {
            $searchModel = new UserSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
            }
            else
            {
            return $this->redirect(Yii::$app->request->baseUrl.'/log/error');
            }
        }
        else 
        {            
        return $this->redirect(Yii::$app->request->baseUrl.'/site/login');    
        }
        
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {  
        if(Yii::$app->session->get('usr_role') != '') {
        $log = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
         if(Yii::$app->session->get('usr_role')  == 'Admin' || Yii::$app->session->get('usr_role')  == 'Superadmin')  
            {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
            }
            else
            {
             return $this->redirect(Yii::$app->request->baseUrl.'/log/error');
            }
        }
        else{
            return $this->redirect(Yii::$app->request->baseUrl.'/site/login'); 
        }
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */   

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    // public function actionUpdate($id)
    // {   $log = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
    //     if(Yii::$app->session->get('usr_role') != '') {
    //         if($log->role == 'Admin' || $log->role == 'Superadmin') 
    //         {
    //             $model = $this->findModel($id);

    //             if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //                 return $this->redirect(['view', 'id' => $model->id]);
    //             } else {
    //                 return $this->render('update', [
    //                     'model' => $model,
    //                 ]);
    //             }
    //         }
    //         else
    //         {
    //         return $this->redirect(Yii::$app->request->baseUrl.'/log/error');
    //         }
    //     }
    //     else {
    //         return $this->redirect(Yii::$app->request->baseUrl.'/site/login'); 
    //     }
      
    // }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {   if(Yii::$app->session->get('usr_role') != '') {    
        $log = User::find()->where(['username' => Yii::$app->user->identity->username])->one();        
        if(Yii::$app->session->get('usr_role')  == 'Admin' || Yii::$app->session->get('usr_role')  =='Superadmin')   
            {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
            }
            else  {
                return $this->redirect(Yii::$app->request->baseUrl.'/log/error');
            }
        }
        else{
            return $this->redirect(Yii::$app->request->baseUrl.'/site/login'); 
        }
        
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
