<?php


use yii\helpers\Html;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use yii\widgets\Pjax;
use app\models\BusDetails;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Logs';
     // $models->sort->sortParam = 'post-sort';  

?>
<div class="log-index">
  <h1><?= Html::encode('Bus-In') ?></h1>
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        
    </p>
  
<?php 
$name = array();
foreach ($log as $rows) {
        $name[] = $rows['bus_no'];      
}

?>
<?php

?>

<?php Pjax::begin(); ?>
<div id="one">

    <?= DataTables::widget([
        'dataProvider' => $dataProvide,
        //'filterModel' => $searchModel,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],               
              [            
            'label' => 'Bus No',
            'value' => 'bus.bus_no',
             'format' => 'raw',
            ],     
            [            
            'label' => 'R No',
            'value' => 'bus.r_no',
             'format' => 'raw',
            ],
             [            
            'label' => date('d-m-Y'),
            'value' => 'timestamp',
             'format' => 'raw',
            ],  
            [           
            'header'=>'Status',
            'filter' => ['Y'=>'Active', 'N'=>'Deactive'],
            'format'=>'raw',    
            'value' => function($model, $key, $index, $column)
            {   
                if($model->timestamp <= '09:00:00')
                {
                    return '<i class="green">ONTIME</i>';
                }
                else
                {   
                    return '<i class="green">IN-</i>|<i class="red">-Late</i>';
                }
            },
            ],           
        ],
         'clientOptions' => [
        
        "info"=>false,
        "responsive"=>true, 
        "dom"=> '',
        
        ],
  
    ]); ?>
</div>
<?php Pjax::end(); ?>
 <h1><?= Html::encode('Bus-Out') ?></h1>
<?= DataTables::widget([
        'dataProvider' => $modelData,
        //'filterModel' => $searchModel,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],               
             [            
            'label' => 'Bus No',
            'value' => 'rf.bus_no',
             'format' => 'raw',
            ],     
            [            
            'label' => 'R No',
            'value' => 'rf.r_no',
             'format' => 'raw',
            ],
             [            
            'label' => date('d-m-Y'),
            'value' => 'timestamp',
             'format' => 'raw',
            ], 
                [           
            'header'=>'Status',
            'filter' => ['Y'=>'Active', 'N'=>'Deactive'],
            'format'=>'raw',    
            'value' => function($model, $key, $index, $column)
            {   
                if($model->timestamp >= '17:45:00')
                {
                    return '<i class="green">OUT</i>';
                }
                else
                {   
                    return '<i class="red">Quick</i>';
                }
            },
            ], 
                 
        ],
         'clientOptions' => [
        
        "info"=>false,
        "responsive"=>true, 
        "dom"=> '',
        
        ],
  
    ]); ?>

<?php 

$this->registerJs(' 
    setInterval(function(){  
         $.pjax.reload({container:"#one"});
    }, 10000);', \yii\web\VIEW::POS_HEAD); 
?>

</div>
