<?php

namespace frontend\controllers;

use Yii;
use app\models\LogOut;
use frontend\models\LogOutSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\User;
use yii\filters\AccessControl;

/**
 * LogOutController implements the CRUD actions for LogOut model.
 */
class LogOutController extends Controller
{
    /**
     * @inheritdoc
     */
   public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','view','delete'],
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
     * Lists all LogOut models.
     * @return mixed
     */
    public function actionIndex()
    {   if(Yii::$app->session->get('usr_role') != ''){
        $searchModel = new LogOutSearch();
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

    /**
     * Displays a single LogOut model.
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
     * Creates a new LogOut model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LogOut();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->log_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing LogOut model.
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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->log_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        }
        else{
           return $this->redirect(['error403']); 
        }
        }
        else{
        return $this->redirect(Yii::$app->request->baseUrl.'/site/login');     
        }
    }

    /**
     * Deletes an existing LogOut model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {   if(Yii::$app->session->get('usr_role') != ''){  
         $log = User::find()->where(['username' => Yii::$app->user->identity->username])->one(); 
        if($log->role == 'Superadmin') 
        {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
        
        }else
        {
           return $this->redirect(['error']);
        }
    }
        else
        {
        return $this->redirect(Yii::$app->request->baseUrl.'/site/login');   
        }
    }

    /**
     * Finds the LogOut model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LogOut the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LogOut::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
