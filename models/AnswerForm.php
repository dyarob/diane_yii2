<?php

namespace app\models;

use yii\base\Model;

class AnswerForm extends Model
{
	public $answer;

	public function rules()
	{
		return [
			[['answer'], 'required'],
		];
	}
}
