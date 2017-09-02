<?php

namespace source\modules\log\models\search;

use source\core\data\ActiveDataProvider;
use source\modules\log\models\Log;
use yii\base\Model;

/**
 * LogSearch represents the model behind the search form about `source\modules\log\models\Log`.
 */
class LogSearch extends Log
{
    public function init() {
        parent::init();
        $this->userValidate = FALSE;
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'level'], 'integer'], [['category', 'prefix', 'message'], 'safe'], [['log_time'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = Log::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query, //'pagination' => [
            //    'pageSize' => 2,
            //],
            'sort' => [
                'defaultOrder' => [
                    'log_time' => SORT_DESC,
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id, 'level' => $this->level, 'log_time' => $this->log_time,
        ]);

        $query->andFilterWhere(['like', 'category', $this->category])->andFilterWhere(['like', 'prefix', $this->prefix])
            ->andFilterWhere(['like', 'message', $this->message]);

        return $dataProvider;
    }
}
