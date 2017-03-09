<?php
namespace frontend\models;

   
    use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
  class ChangePassForm extends Model{
        public $oldpass;
        public $newpass;
        public $repeatnewpass;
       
        public function rules(){
            return [
                [['oldpass','newpass','repeatnewpass'],'required'],
                ['oldpass','findPasswords'],
                ['repeatnewpass','compare','compareAttribute'=>'newpass' ,'message'=>"Passwords don't match"],
            ];
        }
       
        public function findPasswords($attribute, $params){
            $user = User::find()->where([
                'username'=>Yii::$app->user->identity->username
            ])->one();
            $password = $user->password_hash;
            if($password!=$this->oldpass)
                $this->addError($attribute,'Old password is incorrect');
        }
       
        public function attributeLabels(){
            return [
                'oldpass'=>'Old Password',
                'newpass'=>'New Password',
                'repeatnewpass'=>'Repeat New Password',
            ];
        }
    } 