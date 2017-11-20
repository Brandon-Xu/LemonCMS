<?php

namespace source\modules\taxonomy\models\search;

use source\modules\taxonomy\models\Taxonomy;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * TaxonomySearch represents the model behind the search form about `source\modules\taxonomy\models\Taxonomy`.
 */
class TaxonomySearch extends Taxonomy
{
    public $category;
    public function init() {
        parent::init();
        $this->userValidate = FALSE;
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'parent_id', 'contents', 'sort_num'], 'integer'],
            [['name', 'url_alias', 'description', 'category_id', 'category', 'parent_id'], 'safe'],
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
        $query = Taxonomy::find()->with(['subItem']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => -1,
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'category_id' => $this->category,
            'parent_id' => $this->parent_id
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'url_alias', $this->url_alias])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
