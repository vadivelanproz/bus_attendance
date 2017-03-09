<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Bus Log</title>
      <script language="javascript" type="text/javascript">
var message="Not Allowed!"

function click(e) {
    if (document.all) {
        if (event.button == 2) {
        alert(message);
        return false;
        }
    }
    if (document.layers) {
        if (e.which == 3) {
        alert(message);
        return false;
        }
    }
}
if (document.layers) {
    document.captureEvents(Event.MOUSEDOWN);
}
document.onmousedown=click;

}
</script>
   </head>	
   <body>   
      <header>       
      </header>
         <form action="<?= Yii::$app->request->baseUrl.'/api/create-api' ?>" method="post">
        RF ID<br>  
         <input type="text" name="rf_id" value="Mouse">
         <br><br>
         <input type="submit" value="Submit">
         </form>      
      <footer>         
      </footer>      
   </body>   
</html>