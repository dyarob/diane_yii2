<?php
namespace app\models;
use Yii;
use app\models\AnswerSub;

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
class AS_LongFormula extends AnswerSub
{

	public function analyse($nbs_problem, $simpl_fors)
	{
		$words = preg_split('/\s+/', $this->str);	// splits words by any whitespace
											// Ideal case:
											// [0] -> nombre1		(ex 1)
											// [1] -> operateur		(ex +)
											// [2] -> nombre2		(ex 2)
											// [3] -> operateur2	(ex +)
											// [4] -> nombre3		(ex 3)
											// [5] -> equals		(ex =)
											// [6] -> result		(ex 6)
		//  We are going to transform the words into a string
		// with several simple formulas
		// str_result example "1+2=3 3+3=6"
		$str_result = "";
		// First operation:
		$str_result += $words[0];
		$str_result += $words[1];
		$previous_result = (int)$words[0] + (int)$words[1];
		$str_result += "=" + (string)$previous_result + " ";
		// Intermediary operations:
		$l = count($words);
		for ($i = 2; $i < $l - 2; $i += 2)
		{
			$str_result += (string)$previous_result;
			$str_result += $words[$i];
			$str_result += $words[$i + 1];
			if ($words[$i + 2] == "=") // This operation is the final operation
			{
				$str_result += "=" + $words[$i + 3];
				break;
			}
			$str_result += "=" + ((int)$words[$i] + (int)$words[$i + 1]) + " ";
		}
		$model = new Answer;
		$model->fill(NULL, $str_result);
		$model->analyse($nbs_problem);
		$model->save();
	}

}
