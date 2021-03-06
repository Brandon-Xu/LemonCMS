<?php

namespace source\modules\menu\models\search;

use source\modules\menu\models\MenuCategory;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * MenuCategorySearch represents the model behind the search form about `source\modules\menu\models\MenuCategory`.
 */
class MenuCategorySearch extends MenuCategory
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
            [['id', 'name', 'description'], 'safe'],
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
        $query = MenuCategory::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'id', $this->id])->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
