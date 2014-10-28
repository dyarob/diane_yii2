<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "problems".
 *
 * @property integer $id
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
            [['statement', 'numbers'], 'required'],
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
            'statement' => 'Statement',
            'properties' => 'Properties',
            'numbers' => 'Numbers',
        ];
    }
}
