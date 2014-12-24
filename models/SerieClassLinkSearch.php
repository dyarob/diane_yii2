<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SerieClassLink;

/**
 * SerieClassLinkSearch represents the model behind the search form about `app\models\SerieClassLink`.
 */
class SerieClassLinkSearch extends SerieClassLink
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_serie', 'id_class'], 'integer'],
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
        $query = SerieClassLink::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_serie' => $this->id_serie,
            'id_class' => $this->id_class,
        ]);

        return $dataProvider;
    }
}
