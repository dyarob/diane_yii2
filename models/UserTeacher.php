<?php

namespace app\models;

use Yii;
/**
 * This is the model class for table "teachers".
 *
 * @property integer $id
 * @property string $nom
 * @property string $prenom
 * @property string $login
 * @property string $password
 */

class UserTeacher extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;

    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];

    public $repeatpassword;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teachers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nom', 'prenom', 'login', 'password', 'repeatpassword'], 'required'],
	    [['login', 'password', 'repeatpassword'], 'string', 'min' => 6],
	    [['nom', 'prenom'], 'string', 'min' => 3],
            [['nom'], 'string', 'max' => 20],
            [['prenom', 'password'], 'string', 'max' => 16],
            [['login'], 'string', 'max' => 10],
	    [['repeatpassword'], 'compare', 'compareAttribute'=>'password', 'message'=>"Les mots de passe ne correspondent pas."]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nom' => 'Nom',
            'prenom' => 'Prenom',
            'login' => 'Login',
            'password' => 'Password',
        ];
    }

    /**
     * @inheritdoc
     */
	public static function findIdentity($id)
	{
		$dbTeacher = self::find()->where(["id" => $id])
			->one();
		if (!count($dbTeacher)) {
			return null;
		}
		return new static($dbTeacher);
	}

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
	/*
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }
	*/
	$row = (new \yii\db\Query())
		->select('*')
		->from('teachers')
		->where(['login' => $username])
		->one();
	if ($row !== NULL)
	{
	    $user = new UserTeacher;
	    $user->id = $row['id'];
	    $user->username = $row['login'];
	    $user->password = $row['password'];
            $user->authKey = 'test100key';
            $user->accessToken = '100-token';
	    return ($user);
	}

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
