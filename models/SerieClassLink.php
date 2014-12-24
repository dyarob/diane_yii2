<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "series_class".
 *
 * @property integer $id
 * @property integer $id_serie
 * @property integer $id_class
 */
class SerieClassLink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'series_class';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_serie', 'id_class'], 'integer']
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
            'id_class' => 'Id Class',
        ];
    }
}
