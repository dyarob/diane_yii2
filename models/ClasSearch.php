<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Clas;

/**
 * ClasSearch represents the model behind the search form about `app\models\Clas`.
 */
class ClasSearch extends Clas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_teacher'], 'integer'],
            [['name', 'year'], 'safe'],
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
        $query = Clas::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_teacher' => $this->id_teacher,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'year', $this->year]);

        return $dataProvider;
    }
}
