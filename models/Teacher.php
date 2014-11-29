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

class Teacher extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $authKey;
    public $accessToken;
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

	public function getClas()
	{
		return $this->hasMany(Clas::className(), ['id_teacher' => 'id'])
			->where('year=:year', [':year' => date("Y")])
			->indexBy('id')
			->select('id')
			->column();
			//->asArray();
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
	 *  * @inheritdoc
	 *   */
	public static function findIdentityByAccessToken($token, $userType = null) {

		$dbTeacher = self::find()
			->where(["accessToken" => $token])
			->one();
		if (!count($dbTeacher)) {
			return null;
		}
		return new static($dbTeacher);
	}


    /**
     * Finds user by login
     *
     * @param  string      $login
     * @return static|null
     */
    public static function findByUsername($login)
    {
		$dbTeacher = self::find()->where(["login" => $login])
			->one();
		if (!count($dbTeacher)) {
			return null;
		}
		return new static($dbTeacher);
    }

	/**
	 * @inheritdoc
	 */
	public function getId()
	{
		return $this->id;
    }

	/**
	 *  * @inheritdoc
	 *   */
	public function getAuthKey() {
		return $this->authKey;
	}

	/**
	 *  * @inheritdoc
	 *   */
	public function validateAuthKey($authKey) {
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

