<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BusDetails;

/**
 * BusDetailsSearch represents the model behind the search form about `app\models\BusDetails`.
 */
class BusDetailsSearch extends BusDetails
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bus_id','rf_id'], 'integer'],
             [['r_no'], 'string', 'max' => 15],
            [['bus_no', 'driver_name', 'route'], 'safe'],
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
        $query = BusDetails::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'bus_id' => $this->bus_id,
            'r_no' => $this->r_no,
            'rf_id' => $this->rf_id,
        ]);

        $query->andFilterWhere(['like', 'bus_no', $this->bus_no])
            ->andFilterWhere(['like', 'driver_name', $this->driver_name])
            ->andFilterWhere(['like', 'route', $this->route]);

        return $dataProvider;
    }
}
