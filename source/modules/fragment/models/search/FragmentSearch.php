<?php

namespace source\modules\fragment\models\search;

use source\LuLu;
use source\modules\fragment\models\Fragment;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * FragmentSearch represents the model behind the search form about `source\modules\fragment\models\Fragment`.
 */
class FragmentSearch extends Fragment
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
            [['id', 'type'], 'integer'], [['name', 'description'], 'safe'],
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
        $query = Fragment::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->type = app()->request->get('type');
        $query->andFilterWhere([
            'type' => $this->type,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        //         $query->andFilterWhere([
        //             'id' => $this->id,
        //             'type' => $this->type,
        //         ]);

        $query->andFilterWhere(['like', 'name', $this->name])->andFilterWhere([
            'like', 'description', $this->description,
        ]);

        return $dataProvider;
    }
}
