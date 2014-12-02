<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AnswerSub;

/**
 * AnswerSubSearch represents the model behind the search form about `app\models\AnswerSub`.
 */
class AnswerSubSearch extends AnswerSub
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_answer', 'id_resol_typ', 'miscalc'], 'integer'],
            [['op', 'formul', 'str'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = AnswerSub::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_answer' => $this->id_answer,
            'id_resol_typ' => $this->id_resol_typ,
            'miscalc' => $this->miscalc,
        ]);

        $query->andFilterWhere(['like', 'op', $this->op])
            ->andFilterWhere(['like', 'formul', $this->formul])
            ->andFilterWhere(['like', 'str', $this->str]);

        return $dataProvider;
    }
}
