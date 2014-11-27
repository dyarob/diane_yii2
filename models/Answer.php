<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "answers".
 *
 * @property integer $id
 * @property integer $id_student
 * @property integer $id_problem
 * @property string $answer
 * @property integer $op_type
 * @property integer $resol_type
 * @property integer $miscalc
 */
class Answer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'answers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_student', 'id_problem', 'answer', 'op_type', 'resol_type', 'miscalc'], 'required'],
            [['id_student', 'id_problem', 'op_type', 'resol_type', 'miscalc'], 'integer'],
            [['answer'], 'string', 'max' => 240]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_student' => 'Id Student',
            'id_problem' => 'Id Problem',
            'answer' => 'Answer',
            'op_type' => 'Op Type',
            'resol_type' => 'Resol Type',
            'miscalc' => 'Miscalc',
        ];
    }

	public function getStudent()
	{
		return $this->hasOne(Student::className(), ['id' => 'id_student']);
	}
}
