<?php

namespace source\modules\files\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use source\modules\files\models\Files;

/**
 * FileSearch represents the model behind the search form about `source\modules\files\models\Files`.
 */
class FileSearch extends Files
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'driver', 'filename', 'type', 'basename', 'extension', 'basePath', 'absUrl', 'summary'], 'safe'],
            [['size', 'uploaderId', 'created_at', 'created_date'], 'integer'],
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
        $query = Files::find();

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
            'size' => $this->size,
            'uploaderId' => $this->uploaderId,
            'created_at' => $this->created_at,
            'created_date' => $this->created_date,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'driver', $this->driver])
            ->andFilterWhere(['like', 'filename', $this->filename])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'basename', $this->basename])
            ->andFilterWhere(['like', 'extension', $this->extension])
            ->andFilterWhere(['like', 'basePath', $this->basePath])
            ->andFilterWhere(['like', 'absUrl', $this->absUrl])
            ->andFilterWhere(['like', 'summary', $this->summary]);

        return $dataProvider;
    }
}
