<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
use fedemotta\datatables\DataTables;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LogOutSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Log Outs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-out-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Bus In Details', ['log/index'], ['class' => 'btn btn-success']) ?>
    </p>
   
    <?php $form = ActiveForm::begin([ 
    'method' => 'get',
     'enableClientScript' => false,
     
    'options' => ['class' => 'form-horizontal']]);
      ?>
   
    <div class="col-md-3 col-sm-8 col-xs-12">
       <?= $form->field($searchModel, 'bus_no')->textInput() ?>
       </div>

    <div class="col-md-3 col-sm-8 col-xs-12">
      <label>Date</label>
        <?= DatePicker::widget(['class'=>'col-md-4 col-sm-6 col-xs-12',
      
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
    <?php echo Html::submitButton('Search',['class' => 'btn btn-danger']) ?> <?php ActiveForm::end(); ?>
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
            'value' => 'rf.r_no',
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
            ],[
            "sExtends"=> "pdf",
            "sButtonText"=> Yii::t('app',"Save to PDF")
            ],
        ]
        ]
        ],
    ]); ?>
</div>
