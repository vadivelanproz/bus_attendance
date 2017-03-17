<?php

use yii\helpers\Html;
use dosamigos\chartjs\ChartJs;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\daterange\DateRangePicker;
use fedemotta\datatables\DataTables;
use yii\data\SqlDataProvider;
use miloschuman\highcharts\Highcharts;


/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Logs';

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-index">

    <h1><?= Html::encode($this->title) ?></h1>
  
    <p>  
   <?= Html::a('Bus Out Details ', ['log-out/index'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php $form = ActiveForm::begin([ 
      'action' => ['index'],
    'method' => 'get',
     'enableClientScript' => false,
     
    'options' => ['class' => 'form-horizontal']]);
      ?>
    <div class="col-md-3 col-sm-8 col-xs-12">
       <?= $form->field($searchModel, 'bus_no')->textInput() ?>
       </div>

    <div class="col-md-3 col-sm-8 col-xs-12">
      <label>Date</label>
        <?= DatePicker::widget([
      
         'model' => $searchModel,

          'attribute' => 'from_date',
           'value' => '2014-01-01',
            'type' => DatePicker::TYPE_RANGE,
             'attribute2' => 'to_date',
              'value2' => '2016-01-01', 
              'pluginOptions' => [ 'autoclose'=>true,
               'format' => 'yyyy-mm-dd'
                ] 
                ]); ?>
             
   </div> 
   <div class="col-md-3 col-sm-8 col-xs-12"><div><br></div>
    <?php echo Html::submitButton('Search',['class' => 'btn btn-danger','style'=>'margin_bottom:20px;']) ?> <?php ActiveForm::end(); ?>
     </div>
  
    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],             
                       
            [            
            'label' => 'bus_no',
            'value' => 'bus_no',
             'format' => 'raw',
            ],
             [
            
            'label' => 'R No',
            'value' => 'bus.r_no',
            'format' => 'raw',
            ],
            [            
            'label' => 'Date',
            'value' => 'log_date',
            'format' => ['date','php:d-m-Y']
            ],           
            
            [
            'attribute' => 'timestamp',        
            
            ],
            //insert into log(bus_no,rf_id)SELECT bus_details.bus_no,bus_details.rf_id FROM bus_details LEFT JOIN log on bus_details.rf_id = log.rf_id WHERE log.log_date IS NULL 
            [           
            'header'=>'Status',           
            'format'=>'raw',    
            'value' => function($model, $key, $index, $column)
            {                   
               if($model->timestamp <= '09:00:00')
                {
                  return '<i class="green">IN-ONTIME</i>';
                }
                else
                {   
                  return '<i class="green">IN</i>-<i class="red">Late</i>';
                }
            },
        ],     

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'clientOptions' => [
        "lengthMenu"=> [[20,-1], [20,Yii::t('app',"All")]],
        "info"=>false,
        "responsive"=>true, 
        "dom"=> 'lTrtip',
        "tableTools"=>[
        "aButtons"=> [  
            [
            "sExtends"=> "copy",
            "sButtonText"=> Yii::t('app',"Copy to clipboard")
            ],[
            "sExtends"=> "csv",
            "sButtonText"=> Yii::t('app',"Save to CSV")
            ],[
            "sExtends"=> "xls",
            "oSelectorOpts"=> ["page"=> 'current']
            ],
        ]
        ]
        ],
    ]); ?>

</div>
