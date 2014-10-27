<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "students".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $class
 * @property string $year
 * @property integer $teacher
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
            [['first_name', 'class', 'year', 'teacher'], 'required'],
            [['teacher'], 'integer'],
            [['first_name'], 'string', 'max' => 20],
            [['class'], 'string', 'max' => 8],
            [['year'], 'string', 'max' => 4]
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
            'class' => 'Class',
            'year' => 'Year',
            'teacher' => 'Teacher',
        ];
    }
}
