<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbluser".
 *
 * @property string $EmailAddress
 * @property string $UserPassword
 * @property string|null $authKey
 * @property string|null $accessToken
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbluser';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['EmailAddress'], 'string', 'max' => 80],
            [['UserPassword'], 'string', 'max' => 255],
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

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
    public static function findIdentity($id)
    {
        return self::findone($id);
    }
    
    public static function findIdentityByAccessToken($token, $type=null)
    {
        return self::findOne (['accessToken'=>$token]);
    }

    public static function findByEmail($EmailAddress)
    {
        return self::findone(['EmailAddress'=>$EmailAddress]);
    }

    public function getId()
    {
        return $this->UserId;
    }

    public function getAuthkey()
    {
    //    return $this->authKey;
    }

    public function validateAuthkey($authKey) 
    {
        // return $this->authKey == $authKey;
    }

    public function validatePassword($UserPassword)
    {
        return password_verify($UserPassword, $this->UserPassword);
    }

    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }
}
