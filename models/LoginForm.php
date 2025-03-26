<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class LoginForm extends Model
{
    public $EmailAddress;
    public $UserPassword;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['EmailAddress', 'UserPassword'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            ['EmailAddress', 'validateEmail'],
            // password is validated by validatePassword()
            ['UserPassword', 'validatePassword'],
        ];
    }

        /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'EmailAddress' => 'CityU Email',
            'UserPassword' => 'Password',
        ];
    }

    public function validateEmail($attribute, $params)
    {
        if (!$this->hasErrors())
        {
            if(!str_contains($this->EmailAddress, "@city.edu.my"))
            {
                $checkEmail = $this->EmailAddress."@city.edu.my";

                if(!filter_var($checkEmail, FILTER_VALIDATE_EMAIL))
                {
                    $this->addError($attribute, 'Invalid email address');
                }
            }

            $checkEmailExist = User::findByEmail($checkEmail ?? $this->EmailAddress);

            if(empty($checkEmailExist))
            {
                $this->addError($attribute, 'This email does not exist');
            }
        }
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()){
            $user = $this->getUser();

            $md5passEntry = md5($this->UserPassword);

            if($md5passEntry != $user->UserPassword)
            {
                $this->addError($attribute, 'Incorrect email or password.');
            }

            // if (!$user || !$user->validatePassword($this->UserPassword)) {
            //     $this->addError($attribute, 'Incorrect username or password.');
            // }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser($this->UserPassword), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) 
        {
            if(!str_contains($this->EmailAddress, "@city.edu.my"))
            {
                $this->EmailAddress .= "@city.edu.my";
            }

            $this->_user = User::findByEmail($this->EmailAddress);
        }

        return $this->_user;
    }
}
