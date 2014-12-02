<?php

namespace app\models;

use Yii;
use app\models\AnswerSub;

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
 * @property integer $correct
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
            [['answer'], 'required'],
            [['id_student', 'id_problem', 'op_type', 'resol_type', 'miscalc'], 'integer'],
			[['correct'], 'boolean'],
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
			'correct' => 'Correct',
        ];
    }

	public function getStudent()
	{
		return $this->hasOne(Student::className(), ['id' => 'id_student']);
	}

	// Genere des objets formules simples a partir de la chaine de caractere
	// de la reponse.
	// Outputs:
	// - formules simples sous forme d'objects AnswerSub
	public function	find_simpl_for()
	{
		$formulas = array();
		preg_match_all("/\d+\s*[+*-\/]\s*\d+\s*=\s*\d+/",
			$this->answer, $simpl_formulas, PREG_SET_ORDER);
		foreach ($simpl_formulas as $simpl_formula)
		{
			$model = new AnswerSub;
			$model->id_answer = $this->id;
			$model->formul = $simpl_formula[0];
			$model->save();
			array_push($formulas, $model);
		}
		return $formulas;
	}

	// Analyses a simple arithmetic problem answer.
	// WORKS ONLY FOR ADDITIONS / SUBSTRACTIONS!
	// NO NEGATIVE NUMBERS ALLOWED!
	public function	analyse()//$nbs_problem)
	{
		$formulas = $this->find_simpl_for();
		$i = 0;
		foreach ($formulas as $formula)
		{
			// il faut deja reproduire les actions de ce constructeur :
			$this->simpl_fors_obj[$i] = new SimplFormul($simpl_formula[0], $nbs_problem, $this->simpl_fors);
			//$tmp->find_formul($nbs_problem, $this->simpl_fors);
			//$this->simpl_fors_obj[$i]->_print();
			//$this->simpl_fors[$this->simpl_fors_obj[$i]->result] = $this->simpl_fors_obj[$i]->formul;
			//$i++;
		}
		$this->full_exp = $this->simpl_fors_obj[$i - 1]->formul;
	}
}
