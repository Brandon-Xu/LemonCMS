<?php

namespace source\modules\rbac\models\search;

use source\LuLu;
use source\modules\rbac\models\Permission;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PermissionSearch represents the model behind the search form about `source\modules\rbac\models\Permission`.
 */
class PermissionSearch extends Permission
{
    /**
     * @inheritdoc
     */
    public function rules() {
        return [[['id', 'name', 'description'], 'safe'], [['category_id', 'form'], 'integer'],];
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
        $query = Permission::find();
        $query->orderBy('id asc,sort_num desc');

        $dataProvider = new ActiveDataProvider(['query' => $query,]);


        $this->load($params);

        $this->category_id = app()->request->get('category');

        $query->andWhere(['category_id' => $this->category_id,]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['category_id' => $this->category_id, 'form' => $this->form,]);

        $query->andFilterWhere(['like', 'id', $this->id])->andFilterWhere([
            'like', 'name', $this->name,
        ])->andFilterWhere([
            'like', 'description', $this->description,
        ]);

        return $dataProvider;
    }
}
