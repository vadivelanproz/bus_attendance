<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Log;

/**
 * LogSearch represents the model behind the search form about `app\models\Log`.
 */

class LogSearch extends Log
{
    /**
     * @inheritdoc
     */
    public $from_date;
    public $to_date;
    public function rules()
    {
        return [
            [['log_id', 'rf_id','bus_no'], 'integer'],
            [['timestamp', 'dir'], 'safe'],

            [['from_date','to_date'],'safe'],
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
        $query = Log::find();
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
            'log_id' => $this->log_id,
            'rf_id' => $this->rf_id,
            'log_date' => $this->log_date,
            'timestamp' => $this->timestamp, 
            'bus_no' => $this->bus_no,      
        ]);
        $query->orderBy(['log_date' => SORT_DESC]);
        $query->andFilterWhere(['like', 'dir', $this->dir])
         ->andFilterWhere(['between', 'log_date', $this->from_date, $this->to_date]);

        return $dataProvider;
    }
}
