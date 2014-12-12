<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Problem;

/**
 * ProblemSearch represents the model behind the search form about `app\models\Problem`.
 */
class ProblemSearch extends Problem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_serie'], 'integer'],
            [['statement', 'properties', 'numbers'], 'safe'],
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
        $query = Problem::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_serie' => $this->id_serie,
        ]);

        $query->andFilterWhere(['like', 'statement', $this->statement])
            ->andFilterWhere(['like', 'properties', $this->properties])
            ->andFilterWhere(['like', 'numbers', $this->numbers]);

        return $dataProvider;
    }
}
