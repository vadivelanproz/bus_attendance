<?php

namespace frontend\controllers;

use Yii;
use app\models\User;
use app\models\BusDetails;
use frontend\models\BusDetailsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * BusDetailsController implements the CRUD actions for BusDetails model.
 */
class BusDetailsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','create','update','delete'],
                'rules' => [
                    [
                        'actions' => [''],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index','create','update','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
           
        ];
    }
    /**
     * Lists all BusDetails models.
     * @return mixed
     */
    public function actionIndex()
    {   if(Yii::$app->session->get('usr_role') != '') {
        $searchModel = new BusDetailsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        }
        else{
            return $this->redirect(Yii::$app->request->baseUrl.'/site/login');
        }
        
    }
    /**
     * Displays a single BusDetails model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        if(Yii::$app->session->get('usr_role') != ''){
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
        }
        else{
        return $this->redirect(Yii::$app->request->baseUrl.'/site/login');   
        }
        
    }
    /**
     * Creates a new BusDetails model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {   
        if(Yii::$app->session->get('usr_role') != '') {
        $log = User::find()->where(['username' => Yii::$app->user->identity->username])->one();          
        $model = new BusDetails();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->bus_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
        }
        else {
        return $this->redirect(Yii::$app->request->baseUrl.'/site/index');    
        }
        
    }
    /**
     * Updates an existing BusDetails model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)    
    {   
        if(Yii::$app->session->get('usr_role') != '') { 
        $log = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
        
         if($log->role == 'Admin' || $log->role == 'Superadmin') 
        {
            $model = $this->findModel($id);
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->bus_id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
        else{
            return $this->redirect(Yii::$app->request->baseUrl.'/log/error'); 
        }
        }
        else {
        return $this->redirect(Yii::$app->request->baseUrl.'/site/login');    
        }

    }

    /**
     * Deletes an existing BusDetails model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {   if(Yii::$app->session->get('usr_role') != '') {
        $log = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
       
        if($log->role == 'Admin' || $log->role == 'Superadmin') 
        {
        $this->findModel($id)->delete();     
       return $this->redirect(['index']);
          
        }
        else {
        return $this->redirect(Yii::$app->request->baseUrl.'/log/error'); 
        }
        }
        else {
        return $this->redirect(Yii::$app->request->baseUrl.'/site/login');    
        }    
    }
    /**
     * Finds the BusDetails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BusDetails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BusDetails::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
