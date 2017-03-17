<?php

namespace frontend\controllers;
use Yii;
use app\models\Log;
use yii\db\Query;
use frontend\models\LogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\User;



/**
 * LogController implements the CRUD actions for Log model.
 */
class LogController extends Controller
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
                        'actions' => ['index','view','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    
                ],
            ],             
           
        ];
    }


    /**
     * Lists all Log models.
     * @return mixed
     */
    public function actionIndex()
    {   
        if(Yii::$app->session->get('usr_role') != ''){
        // $query1 = new Query;
        // $query1  ->select(['log.log_id as id','bus_details.bus_no','log.log_date','log.timestamp'])  
        // ->from('log')  
        // ->innerJoin('bus_details','bus_details.rf_id = log.rf_id');       
        // $command1 = $query1->createCommand();
        // $models = $command1->queryAll();  
        $searchModel = new LogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
       
        ]);
        }
        else {
            return $this->redirect(Yii::$app->request->baseUrl.'/site/login');
        }

    }
public function actionRfid()
    {   

        
        return $this->render('log');        
    }

    /**
     * Displays a single Log model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
   
    }

    /**
     * Creates a new Log model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {   if(Yii::$app->session->get('usr_role') != ''){ 
        $model = new Log();
        $model->log_date = date("Y-d-m");
        $model->timestamp = date("H:i:s");
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->log_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
        }
        else{
            return $this->redirect(Yii::$app->request->baseUrl.'/site/login'); 
        }
    }


    /**
     * Updates an existing Log model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {   
        if(Yii::$app->session->get('usr_role') != ''){ 
         $log = User::find()->where(['username' => Yii::$app->user->identity->username])->one(); 
        if($log->role == 'Superadmin') 
        {
        $model = $this->updatedata($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->log_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
         }
        else
        {
           return $this->redirect(['error403']);
        }
        }
        else{
            return $this->redirect(Yii::$app->request->baseUrl.'/site/login'); 
        }
    }

    /**
     * Deletes an existing Log model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {    if(Yii::$app->session->get('usr_role') != ''){  
         $log = User::find()->where(['username' => Yii::$app->user->identity->username])->one(); 
        if($log->role == 'Superadmin') 
        {
        $this->findModel($id)->delete();
         
        return $this->redirect(['index']);
        }
        else
        {
           return $this->redirect(['error403']);
        }
        }
        else{
            return $this->redirect(Yii::$app->request->baseUrl.'/site/login'); 
        }
       
    }

    /**
     * Finds the Log model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Log the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {   
        if (($model = Log::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function updatedata($id)
    {
        if (($model = Log::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

    }
    public function actionError()
    {
            return $this->render('error403');

    }
}
