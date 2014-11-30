<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "series".
 *
 * @property integer $id
 * @property string $name
 * @property integer $nbr_of_problems
 */
class Serie extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'series';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nbr_of_problems'], 'integer'],
            [['name'], 'string', 'max' => 40]
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
            'nbr_of_problems' => 'Nbr Of Problems',
        ];
    }
}
