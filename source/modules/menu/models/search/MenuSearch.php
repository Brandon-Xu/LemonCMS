<?php

namespace source\modules\menu\models\search;

use source\modules\menu\models\Menu;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Query;

/**
 * MenuSearch represents the model behind the search form about `source\modules\menu\models\Menu`.
 */
class MenuSearch extends Menu
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
            [['id', 'parent_id', 'sort_num'], 'integer'],
            [['name', 'url', 'target', 'description', 'thumb', 'category', 'parent_id'], 'safe'],
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
        $query = Menu::find()->with('subItem')->orderBy();

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
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'category_id' => $this->category_id,
            'target' => $this->target
        ]);

        $query->andFilterWhere([
            'category_id' => $this->category,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'thumb', $this->thumb]);

        return $dataProvider;
    }
}
