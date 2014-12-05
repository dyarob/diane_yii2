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
	public					$nbs;
	public					$result;


	public function			analyse($nbs_problem, $simpl_fors)
	{
		preg_match_all("/\d+/", $this->str, $nbs);
		$this->nbs = $nbs[0];
		$this->find_op();
		$this->find_resol_typ($nbs_problem, $simpl_fors);
		$this->find_miscalc();
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
	private function	find_resol_typ($nbs_problem, $simpl_fors)
	{
		$is_nb0 = array_key_exists($this->nbs[0], $nbs_problem);
		if ($is_nb0 === FALSE)
			$is_nb0 = array_key_exists($this->nbs[0], $simpl_fors);
		$is_nb1 = array_key_exists($this->nbs[1], $nbs_problem);
		if ($is_nb1 === FALSE)
			$is_nb1 = array_key_exists($this->nbs[1], $simpl_fors);
		// Test de la substraction inverse
		if ($this->op === "-" && $this->nbs[0] < $this->nbs[1])
		{
			$this->id_resol_typ = 1; // soustraction inverse
			$this->result = $this->nbs[2];
			$this->formul = $nbs_problem[$this->nbs[1]] . $this->formul;
			$this->formul .= $nbs_problem[$this->nbs[0]];
		}
		// Reste
		else if ($is_nb0 !== FALSE)
		{
			if ($is_nb1 !== FALSE)
			{
				$this->id_resol_typ = 2; // operation simple
				$this->result = $this->nbs[2];
				if (array_key_exists($this->nbs[0], $nbs_problem) !== FALSE)
					$this->formul = $nbs_problem[$this->nbs[0]] . $this->formul;
				else
					$this->formul = "(" . $simpl_fors[$this->nbs[0]] . ")" . $this->formul;
				if (array_key_exists($this->nbs[1], $nbs_problem) !== FALSE)
					$this->formul .= $nbs_problem[$this->nbs[1]];
				else
					$this->formul .= "(" . $simpl_fors[$this->nbs[1]] . ")";
			}
			else
			{
				$this->result = $this->nbs[1];
				// Test de la soustraction par l'addition a trou
				if ($this->op === "+")
				{
					$this->op = "-";
					$this->id_resol_typ = 3; // addition a trou
					$this->formul = $nbs_problem[$this->nbs[2]] . " - ";
					$this->formul .= $nbs_problem[$this->nbs[0]];
				}
				else	// soustraction a trou standard
				{
					$this->id_resol_typ = 4; // soustraction a trou
					$this->formul = $nbs_problem[$this->nbs[0]] . $this->formul;
					$this->formul .= $nbs_problem[$this->nbs[2]];
				}
			}
		}
		else
		{
			if ($is_nb1 !== FALSE)
			{
				$this->result = $this->nbs[0];
				// Test de l'addition par la soustraction a trou
				if ($this->op === "-")
				{
					$this->op = "+";
					$this->id_resol_typ = 4; // soustraction a trou
					$this->formul = $nbs_problem[$this->nbs[2]] . " + ";
					$this->formul .= $nbs_problem[$this->nbs[1]];
				}
				// Test de la soustraction par l'addition a trou
				else if ($this->op === "+")
				{
					$this->op = "-";
					$this->id_resol_typ = 3; //addition a trou
					$this->formul = $nbs_problem[$this->nbs[2]] . " - ";
					$this->formul .= $nbs_problem[$this->nbs[1]];
				}
			}
			else
			{
				$this->id_resol_typ = 5;
				$this->result = $this->nbs[2];
			}
		}
	}

	// Outputs:
	// - calcul_error (int)
	private function	find_miscalc()
	{ 
		switch($this->op)
		{
			case "+" :
				if ($this->id_resol_typ === 4) // soustraction a trou
					$this->miscalc =
						abs((int)$this->nbs[2] - (int)$this->nbs[0] + (int)$this->nbs[1]);
				else
					$this->miscalc =
						abs((int)$this->nbs[2] - (int)$this->nbs[0] - (int)$this->nbs[1]);
				break;
			case "-" :
				if ($this->id_resol_typ === 3) // addition a trou
					$this->miscalc =
						abs((int)$this->nbs[2] - (int)$this->nbs[0] - (int)$this->nbs[1]);
				else if ($this->id_resol_typ === 1) // soustraction inverse
					$this->miscalc =
						abs((int)$this->nbs[2] - (int)$this->nbs[1] + (int)$this->nbs[0]);
				else
					$this->miscalc =
						abs((int)$this->nbs[2] - (int)$this->nbs[0] + (int)$this->nbs[1]);
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
