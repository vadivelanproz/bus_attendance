<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/> 
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php AppAsset::register($this); $this->head();  ?>
</head>
<body class="nav-md">
   <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><span>BUS MANAGEMENT</span></a>
            </div>           
          <h4 style="margin-left:45px;">Welcome</h4>           
          <h4 style="margin-left:45px;color:red"> <?php echo
                Yii::$app->session->get('usr_name');?></h4>
            <br/>
            <br/>       

              <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section active">
                <h3></h3>
                <ul class="nav side-menu" style="">
                 
                  <li class="active"><a href="<?= Yii::$app->request->baseUrl.'/site/index'?>" ><i class="glyphicon glyphicon-home"> </i> HOME <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" style="display: block;">
                      <li ><a href="<?= Yii::$app->request->baseUrl.'/log/index'?>"> <i class="glyphicon glyphicon-tasks"></i>   Bus Logs</a></li>
                      <li ><a href="<?= Yii::$app->request->baseUrl.'/bus-details/index'?>"><i class="glyphicon glyphicon-inbox"></i> Bus Details</a></li>
                      <li ><a href="<?= Yii::$app->request->baseUrl.'/user/index'?>"><i class="glyphicon glyphicon-user"></i> User Details</a></li>
                  </ul>
                  </li>      
                 
                
                </ul>
              </div>
         

            </div>

           

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a href="<?= Yii::$app->request->baseUrl.'/site/changepassword'?>" data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
            
              <a href="<?= Yii::$app->request->baseUrl.'/site/logout'?>" data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">

          <div class="nav_menu">
            <nav class="" role="navigation">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  
                    
         
             <a href="<?= Yii::$app->request->baseUrl.'/site/logout'?>">    Logout</a>
                 
                </li>

               

              </ul> 

            </nav>
          </div>

        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">

        
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                 
                  <div class="x_content">
 <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>

                  </div>
                </div>
              </div>       
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Powerd by <a href="http://www.knowledgeelectronics.in/">Knowledge Electronics</a> Developed by <a href="http://www.pro-z.in">ProZ</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
