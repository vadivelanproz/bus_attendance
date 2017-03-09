<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $retype_password;
    public $role;
   
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            
            ['role', 'required'],
            ['password', 'required'],
            ['retype_password', 'required'],
            ['password', 'string', 'min' => 6],            
            ['retype_password', 'compare', 'compareAttribute'=>'password', 'skipOnEmpty' => false, 'message'=>"Passwords don't match"],
        ];
    }
     public function attributeLabels()
    {
        return [
           
            'username' => 'Username',
            'role'=>'Role',
            'password' => 'Password',
            'retype_password' => 'Confirm Password',
        ];
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }        
        $user = new User();
        $user->username = $this->username;
        $user->role= $this->role;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
    
}
