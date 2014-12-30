<?php
namespace app\models;
use Yii;

/**
 * This is the model class for table "answers_sub".
 *
 * @property integer $id
 * @property integer $id_answer
 * @property string $op
 * @property integer $id_resol_typ
 * @property integer $miscalc
 * @property string $formul
 * @property string $str
 */
class AnswerSub extends \yii\db\ActiveRecord
{
	public					$nbs;		// all the numbers in the expression
										// prior to any treatment
	public					$operands;	// array like ['left'] => left operand,
										//			  ['right'] => right operand
	public					$result;
	public					$simpl_fors;

	public function			fill($id_answer, $str = NULL, $simpl_fors = NULL)
	{
		$this->id_answer = $id_answer;
		$this->str = $str;
		$this->simpl_fors = $simpl_fors;
	}

	public function			analyse($nbs_problem, $simpl_fors)
	{
		$this->simpl_fors = $simpl_fors;
		preg_match_all("/\d+/", $this->str, $nbs);
		$this->nbs = $nbs[0];
		$this->find_op();
		$this->find_resol_typ($nbs_problem);
		$this->find_miscalc();
		$this->create_formula($nbs_problem);
		return ($this->simpl_fors);
	}

	// Computes;
	// - Operation type as in enum Type_d_Operation
	private function	find_op()
	{
		if (strstr($this->str, "+") !== FALSE)
		{
			$this->op = "+";
			$this->formul = " + ";
		}
		else if (strstr($this->str, "-") !== FALSE)
		{
			$this->op = "-";
			$this->formul = " - ";
		}
	}

	// Outputs:
	// - resolution type as in enum Type_d_Resolution
	// Trick :
	// $nbs_problem a la forme " x, y, z,"
	// pour faciliter la reconnaissance des nombres
	// et ne pas confondre 4 et 45 par exemple.
	private function	find_resol_typ($nbs_problem)
	{
		$is_nb0 = array_key_exists($this->nbs[0], $nbs_problem);
		if ($is_nb0 === FALSE)
			$is_nb0 = array_key_exists($this->nbs[0], $this->simpl_fors);
		$is_nb1 = array_key_exists($this->nbs[1], $nbs_problem);
		if ($is_nb1 === FALSE)
			$is_nb1 = array_key_exists($this->nbs[1], $this->simpl_fors);
		$is_nb2 = array_key_exists($this->nbs[2], $nbs_problem);
		if ($is_nb2 === FALSE)
			$is_nb2 = array_key_exists($this->nbs[2], $this->simpl_fors);

/*
		// Test de la substraction inverse
		if ($this->op === "-" && $this->nbs[0] < $this->nbs[1]) {
			$this->id_resol_typ = 1; // soustraction inverse
			$this->result = $this->nbs[2];
			$this->formul = $nbs_problem[$this->nbs[1]] . $this->formul;
			$this->formul .= $nbs_problem[$this->nbs[0]];
		}
*/

		switch (TRUE)								// isnb0|isnb1|isnb2
		{
		case (!$is_nb0 && !$is_nb1 && !$is_nb2):	// FALSE FALSE FALSE
			$this->detect_mental_calcul($this->nbs[0], $nbs_problem);
			if (isset($this->simpl_fors[$this->nbs[0]])) {
				$this->find_resol_typ($nbs_problem);
				return ; }
			$this->detect_mental_calcul($this->nbs[1], $nbs_problem);
			if (isset($this->simpl_fors[$this->nbs[1]])) {
				$this->find_resol_typ($nbs_problem);
				return ; }
			$this->detect_mental_calcul($this->nbs[2], $nbs_problem);
			if (isset($this->simpl_fors[$this->nbs[2]])) {
				$this->find_resol_typ($nbs_problem);
				return ; }
			$this->id_resol_typ = 5;
			$this->result = $this->nbs[2];
			return ;

		case ($is_nb0 && !$is_nb1 && !$is_nb2):		// TRUE  FALSE FALSE
			$this->detect_mental_calcul($this->nbs[1], $nbs_problem);
			if (isset($this->simpl_fors[$this->nbs[1]])) {
				$this->find_resol_typ($nbs_problem);
				return ; }
			$this->detect_mental_calcul($this->nbs[2], $nbs_problem);
			if (isset($this->simpl_fors[$this->nbs[2]])) {
				$this->find_resol_typ($nbs_problem);
				return ; }
			$this->id_resol_typ = 5;
			$this->result = $this->nbs[2];
			return ;

		case (!$is_nb0 && $is_nb1 && !$is_nb2):		// FALSE TRUE  FALSE
			$this->detect_mental_calcul($this->nbs[0], $nbs_problem);
			if (isset($this->simpl_fors[$this->nbs[0]])) {
				$this->find_resol_typ($nbs_problem);
				return ; }
			$this->detect_mental_calcul($this->nbs[2], $nbs_problem);
			if (isset($this->simpl_fors[$this->nbs[2]])) {
				$this->find_resol_typ($nbs_problem);
				return ; }
			$this->id_resol_typ = 5;
			$this->result = $this->nbs[2];
			return ;

		case (!$is_nb0 && !$is_nb1 && $is_nb2):		// FALSE FALSE TRUE
			$this->detect_mental_calcul($this->nbs[0], $nbs_problem);
			if (isset($this->simpl_fors[$this->nbs[0]])) {
				$this->find_resol_typ($nbs_problem);
				return ; }
			$this->detect_mental_calcul($this->nbs[1], $nbs_problem);
			if (isset($this->simpl_fors[$this->nbs[1]])) {
				$this->find_resol_typ($nbs_problem);
				return ; }
			$this->id_resol_typ = 5;
			$this->result = $this->nbs[2];
			return ;

		case (!$is_nb0 && $is_nb1 && $is_nb2):		// FALSE TRUE  TRUE
			$this->operands['left'] = $this->nbs[2];
			$this->operands['right'] = $this->nbs[1];
			$this->result = $this->nbs[0];
			switch ($this->op) {
			case "+":
				$this->id_resol_typ = 3; // addition a trou
				$this->op = "-";
				return ;
			case "-":
				$this->id_resol_typ = 4; // soustraction a trou
				$this->op = "+";
				return ;
			}
			break;

		case ($is_nb0 && !$is_nb1 && $is_nb2):		// TRUE  FALSE TRUE
			switch ($this->op) {
			case "+":
				$this->operands['left'] = $this->nbs[2];
				$this->operands['right'] = $this->nbs[0];
				$this->result = $this->nbs[1];
				$this->id_resol_typ = 3; // addition a trou
				$this->op = "-";
				return ;
			case "-":
				$this->operands['left'] = $this->nbs[0];
				$this->operands['right'] = $this->nbs[2];
				$this->result = $this->nbs[1];
				$this->id_resol_typ = 4; // soustraction a trou
				return ;
			}
			break;

		case ($is_nb0 && $is_nb1 && !$is_nb2):		// TRUE  TRUE  FALSE
			$this->operands['left'] = $this->nbs[0];
			$this->operands['right'] = $this->nbs[1];
			$this->result = $this->nbs[2];
			switch ($this->op) {
			case "+":
				$this->id_resol_typ = 2;
				return ;
			case "-":
				$this->id_resol_typ = 2;
				return ;
			}
			break;

		case ($is_nb0 && $is_nb1 && $is_nb2):		// TRUE  TRUE  TRUE
			$this->id_resol_typ = 2;
			$this->result = $this->nbs[2];
			return ;
		}
	}

	private function	create_formula($nbs_problem)
	{
		if (!isset($this->operands['left']))
			$this->formul = $this->nbs[0] . $this->formul;
		else if (isset($nbs_problem[$this->operands['left']]))
			$this->formul = $nbs_problem[$this->operands['left']] . $this->formul;
		else
			$this->formul = "(" . $this->simpl_fors[$this->operands['left']] . ")" . $this->formul;
		if (!isset($this->operands['right']))
			$this->formul .= $this->nbs[1];
		else if (isset($nbs_problem[$this->operands['right']]))
			$this->formul .= $nbs_problem[$this->operands['right']];
		else
			$this->formul .= "(" . $this->simpl_fors[$this->operands['right']] . ")";
	}

	// To be modified in order to add more operations.
	// (or just make it better with tables and structures)
	public function	detect_mental_calcul($n, $nbs_problems)
	{
		$nbs = $nbs_problems;
		array_merge($nbs, $this->simpl_fors);
		foreach ($nbs as $nb1 => $exp1) {
			foreach ($nbs as $nb2 => $exp2) {
				if ($n == $nb1 + $nb2) {
					$this->create_answersub("+", $n, $exp1, $exp2);
					return ;
				}
				else if ($n == $nb1 - $nb2) {
					$this->create_answersub("-", $n, $exp1, $exp2);
					return ;
				}
				else if ($n == $nb2 - $nb1) {
					$this->create_answersub("-", $n, $exp2, $exp1);
					return ;
				}
			}
		}
	}

	public function	create_answersub($op, $n, $exp1, $exp2)
	{
		$model = new AnswerSub;
		$model->id_answer = $this->id_answer;
		$model->op = $op;
		$model->id_resol_typ = 6; // calcul mental / resol type inconnu
		$model->miscalc = 0;
		$model->str = (string)$n;
		$model->formul = $exp1 . " " . $op . " " . $exp2;
		$this->simpl_fors[$n] = $model->formul;
		$model->save();
	}

	// Outputs:
	// - calcul_error (int)
	private function	find_miscalc()
	{ 
		switch($this->op)
		{
			case "+" :
				$this->miscalc = abs(($this->operands['left'] + $this->operands['right'])
									- $this->result);
				break;
			case "-" :
				$this->miscalc = abs(($this->operands['left'] - $this->operands['right'])
									- $this->result);
				break;
		}
	}

    /**
     * @inheritdoc
     */
    public static function	tableName()
    {
        return 'answers_sub';
    }

    /**
     * @inheritdoc
     */
    public function			rules()
    {
        return [
            [['id_answer', 'id_resol_typ', 'miscalc'], 'integer'],
            [['formul'], 'string', 'max' => 33],
            [['op'], 'string', 'max' => 1],
            [['str'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function			attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_answer' => 'Id Answer',
            'op' => 'Op',
            'id_resol_typ' => 'Id Resol Typ',
            'miscalc' => 'Miscalc',
            'formul' => 'Formul',
            'str' => 'Str',
        ];
    }
}
