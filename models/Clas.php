<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "classes".
 *
 * @property integer $id
 * @property string $name
 * @property integer $id_teacher
 * @property string $year
 */
class Clas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'classes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_teacher'], 'integer'],
            [['name'], 'string', 'max' => 10],
            [['year'], 'string', 'max' => 6]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'id_teacher' => 'Id Teacher',
            'year' => 'Year',
        ];
    }
}
