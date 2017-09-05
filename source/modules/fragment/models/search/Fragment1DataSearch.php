<?php

namespace source\modules\fragment\models\search;

use source\LuLu;
use source\modules\fragment\models\Fragment1Data;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Fragment1DataSearch represents the model behind the search form about `source\modules\fragment\models\Fragment1Data`.
 */
class Fragment1DataSearch extends Fragment1Data
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
            [['id', 'fragment_id', 'sort_num', 'status'], 'integer'], [['title', 'content'], 'safe'],
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
        $query = Fragment1Data::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->fragment_id = app()->request->get('fid');
        $query->andFilterWhere([
            'fragment_id' => $this->fragment_id,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        //         $query->andFilterWhere([
        //             'id' => $this->id,
        //             'fragment_id' => $this->fragment_id,
        //             'sort_num' => $this->sort_num,
        //             'status' => $this->status,
        //         ]);

        $query->andFilterWhere(['like', 'title', $this->title])->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
