<?php
namespace app\models;
use Yii;
/**
 * This is the model class for table "students".
 *
 * @property integer $id
 * @property string $first_name
 * @property integer $id_class
 */
class Student extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'students';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'id_class'], 'required'],
            [['id_class'], 'integer'],
            [['first_name'], 'string', 'max' => 20],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'id_class' => 'Id Class',
        ];
    }

	public function getAnswers()
	{
		return $this->hasMany(Answer::className(), ['id_student' => 'id']);
	}

	public function getClas()
	{
		return $this->hasOne(Clas::className(), ['id' => 'id_class'])//->where('year=:year', [':year' => date("Y")]);
		;
	}

	public function getSeries()
	{
		return $this->clas->getSeries();
	}
}
