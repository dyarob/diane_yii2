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
class Teacher extends \yii\db\ActiveRecord
{
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
}
