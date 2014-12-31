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
 * @property integer $miscalc
 * @property integer $correct
 * @property string $formul
 * @property integer $id_strategy
 */
class Answer extends \yii\db\ActiveRecord
{

	public function fill($id_student, $str = NULL)
	{
		$this->id_student = $id_student;
		if ($str !== NULL)
			$this->answer = $str;
	}

	// Analyses a simple arithmetic problem answer.
	// WORKS ONLY FOR ADDITIONS / SUBSTRACTIONS!
	// NO NEGATIVE NUMBERS ALLOWED!
	public function	analyse($nbs_problem)
	{
		$simpl_fors = array();
		preg_match_all("/\d+\s*[+*-\/]\s*\d+\s*=\s*\d+/",
			$this->answer, $simpl_formulas, PREG_SET_ORDER);
		foreach ($simpl_formulas as $simpl_formula)
		{
			$model = new AnswerSub;
			$model->fill($this->id, $simpl_formula[0]);
			//$model->id_answer = $this->id;
			//$model->str = $simpl_formula[0];
			$model->analyse($nbs_problem, $simpl_fors);
			$model->save();
			$simpl_fors[$model->result] = $model->formul;
		}
		preg_match_all("/(?![+*-\/=])\s*\d+\s*(?![+*-\/=])/",
			$this->answer, $lone_nbs, PREG_SET_ORDER);
		foreach($lone_nbs as $lone_nb)
		{
			$model = new AS_LoneNb;
			$model->fill($this->id, $lone_nb[0], $simpl_fors);
			//$model->id_answer = $this->id;
			//$model->str = $lone_nb[0];
			//$model->simpl_fors = $simpl_fors;
			$model->detect_mental_calcul($lone_nb[0], $nbs_problem);
		}
		preg_match_all("/\d+\s*[+*-\/]\s*(\d+\s*[+*-\/]\s*)+\d+\s*=\s*\d+/",
			$this->answer, $long_formulas, PREG_SET_ORDER);
		foreach($long_formulas as $long_formula)
		{
			$model = new AS_LongFormula;
			$model->fill($this->id, $long_formula[0], $simpl_fors);
			//$model->id_answer = $this->id;
			//$model->str = $long_formula[0];
			//$model->simpl_fors = $simpl_fors;
			$model->analyse($nbs_problem, $simpl_fors);
		}
	}

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
            [['id_student', 'id_problem', 'miscalc', 'id_strategy'], 'integer'],
			[['correct'], 'boolean'],
            [['answer'], 'string', 'max' => 240],
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
            'id_student' => 'Id Student',
            'id_problem' => 'Id Problem',
            'answer' => 'Answer',
            'miscalc' => 'Miscalc',
			'correct' => 'Correct',
            'formul' => 'Formul',
			'id_strategy' => 'Id Strategy',
        ];
    }

	public function getStudent()
	{
		return $this->hasOne(Student::className(), ['id' => 'id_student']);
	}

	public function getSubanswers()
	{
		return $this->hasMany(AnswerSub::className(), ['id_answer' => 'id'])->AsArray();
	}
}
