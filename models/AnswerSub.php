<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "answers_sub".
 *
 * @property integer $id
 * @property integer $id_answer
 * @property integer $id_op_typ
 * @property integer $id_resol_typ
 * @property integer $miscalc
 * @property string $formul
 */
class AnswerSub extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'answers_sub';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_answer', 'id_op_typ', 'id_resol_typ', 'miscalc'], 'integer'],
            [['formul'], 'string', 'max' => 33]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_answer' => 'Id Answer',
            'id_op_typ' => 'Id Op Typ',
            'id_resol_typ' => 'Id Resol Typ',
            'miscalc' => 'Miscalc',
            'formul' => 'Formul',
        ];
    }
}
