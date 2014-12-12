<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "problems".
 *
 * @property integer $id
 * @property integer $id_serie
 * @property string $statement
 * @property string $properties
 * @property string $numbers
 */
class Problem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'problems';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_serie'], 'integer'],
            [['statement'], 'string', 'max' => 600],
            [['properties'], 'string', 'max' => 100],
            [['numbers'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_serie' => 'Id Serie',
            'statement' => 'Statement',
            'properties' => 'Properties',
            'numbers' => 'Numbers',
        ];
    }
}
