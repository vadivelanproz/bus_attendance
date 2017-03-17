<?php

namespace frontend\controllers;
use Yii;
use app\models\Log;
use app\models\BusDetails;
use app\models\LogOut;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;

class ApiController extends \yii\web\Controller
{
  public function behaviors()
  {
    return [      
      'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [          
          'bus-in'=>['post'], 
          'bus-out'=>['post'], 
        ],        
      ]
    ];
  }    
  public function beforeAction($event)
  {
    $action = $event->id;  
    if (isset($this->actions[$action])) {
      $verbs = $this->actions[$action];
    } 
    elseif (isset($this->actions['*'])) {
      $verbs = $this->actions['*'];
    } 
    else {
      return $event->isValid;
    }
    $verb = Yii::$app->getRequest()->getMethod(); 
    $allowed = array_map('strtoupper', $verbs);    
    if (!in_array($verb, $allowed)) {          
      $this->setHeader(400);
      echo json_encode(array('status'=>"error",'data'=>array('message'=>'method not allowed')),JSON_PRETTY_PRINT);
      exit;          
    }         
   return true;  
  }   
 
 
  //add the materil purchased in db
  public function actionBusIn() {       
    $params = Yii::$app->getRequest()->getBodyParams();
    date_default_timezone_set('Asia/Kolkata');
    $id =Yii::$app->getRequest()->getQueryParam('rf_id');
    $bus = $this->findModel($id); 
    $model = new Log();
    $model->timestamp = date("H:i");
    $model->log_date = date("Y-m-d");
    $model->rf_id = $id;  
    $model->bus_no = $bus['bus_no'];
    if ($model->save()) {      
      $this->setHeader(200);
      echo json_encode(array("message"=>'record saved successfully'),JSON_PRETTY_PRINT);        
    } 
    else {
      $this->setHeader(400);    
      echo json_encode(array_filter($model->errors),JSON_PRETTY_PRINT);
    }     
  } 
  public function actionBusOut() {       
   $params = Yii::$app->getRequest()->getBodyParams();
    date_default_timezone_set('Asia/Kolkata');
   $id =Yii::$app->getRequest()->getQueryParam('rf_id');
   $bus = $this->findModel($id);
    $model = new LogOut();
    $model->timestamp = date("H:i");
    $model->log_date = date("Y-m-d");
    $model->rf_id = $id; 
    $model->bus_no = $bus['bus_no'];     
    if ($model->save()) {      
      $this->setHeader(200);
      echo json_encode(array('message'=>'record saved successfully'),JSON_PRETTY_PRINT);        
    } 
    else {
      $this->setHeader(400);    
      echo json_encode(array_filter($model->errors),JSON_PRETTY_PRINT);
    }     
  } 
 
  protected function findModel($id) { 
    if (($model = BusDetails::find()->where(['rf_id' => $id])->one()) !== null) {
      return $model;
    }
    else {
      $this->setHeader(400);
      echo json_encode(array('message'=>'Invalid RF ID'),JSON_PRETTY_PRINT);
      exit;
    }
  }
    //setting the header 
    private function setHeader($status) {    
      $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
      $content_type = "application/json";  
      header($status_header);
      header('Content-type: ' . $content_type);
      header('X-Powered-By: ' . "ProZ Solutions");
    }
    //get the status code with error msg
    private function _getStatusCodeMessage($status)
    {
      $codes = Array(
        200 => 'OK.',
        201 =>'A resource was successfully created in response to a POST request. The Location header contains the URL pointing to the newly created resource.',
        204 =>  'The request was handled successfully and the response contains no content.', 
        304 =>  'The resource was not modified.',
        400 =>  'Bad request.',
        401 =>  'Authentication failed.',
        403 =>  'The authenticated user is not allowed to access the specified API endpoint.',
        404 =>  'The resource does not exist.',
        405 =>  'Method not allowed.',
        415 =>  'Unsupported media type.',
        422 =>  'Data validation failed.',
        429 =>  'Too many requests.',
        500 =>  'Internal server error.',     
      );
    return (isset($codes[$status])) ? $codes[$status] : '';
    }

}
