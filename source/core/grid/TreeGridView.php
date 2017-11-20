<?php

namespace source\core\grid;

use yii\base\Model;
use yii\db\ActiveRecord;
use yii\grid\Column;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class TreeGridView extends GridView
{

    public $tabAttribute = 'name';
    public $relationAttribute = 'subItem';
    public $tabItem = '-';
    public $tabStep = 6;
    public $tabFirst = '|';

    /**
     * Renders the table body.
     * @return string the rendering result.
     */
    public function renderTableBody()
    {
        $models = array_values($this->dataProvider->getModels());
        $keys = $this->dataProvider->getKeys();
        $rows = [];

        $this->renderTableRowByModel($models, $keys, $rows);

        if (empty($rows) && $this->emptyText !== false) {
            $colspan = count($this->columns);

            return "<tbody>\n<tr><td colspan=\"$colspan\">" . $this->renderEmpty() . "</td></tr>\n</tbody>";
        }

        return "<tbody>\n" . implode("\n", $rows) . "\n</tbody>";
    }

    protected function tabString($num){
        if($num >= $this->tabStep){
            $spaceNum = $num - $this->tabStep;
            $t = str_repeat('&nbsp;', $spaceNum + $this->tabStep) . $this->tabFirst . str_repeat($this->tabItem, $this->tabStep - 1);
            return $t;
        }
        return '';
    }

    /**
     * @param ActiveRecord[] $models
     * @param $keys
     * @param $rows
     * @param int $tabNum
     */
    protected function renderTableRowByModel($models, $keys, &$rows, $tabNum = 0){
        $tabString = $this->tabString($tabNum);

        foreach ($models as $index => $model) {
            $key = $keys[$index];
            if ($this->beforeRow !== null) {
                $row = call_user_func($this->beforeRow, $model, $key, $index, $this);
                if (!empty($row)) {
                    $rows[] = $row;
                }
            }

            $rows[] = $this->renderTableRow($model, $key, $index, $tabString);

            if ($this->afterRow !== null) {
                $row = call_user_func($this->afterRow, $model, $key, $index, $this);
                if (!empty($row)) {
                    $rows[] = $row;
                }
            }

            $subItem = $model->{$this->relationAttribute};
            if(!empty($subItem)){
                $subItemKeys = ArrayHelper::getColumn($subItem, function($model){
                    /** @var $model ActiveRecord */
                    return $model->primaryKey;
                });

                $tabNum += $this->tabStep;
                $this->renderTableRowByModel($subItem, $subItemKeys, $rows, $tabNum);
            }
        }
    }


    public function renderTableRow($model, $key, $index, $tab = '')
    {
        $cells = [];
        /* @var $column Column|\yii\grid\DataColumn */
        foreach ($this->columns as $column) {
            if($column instanceof \yii\grid\DataColumn && $column->attribute == $this->tabAttribute){
                $model->{$this->tabAttribute} = $tab . $model->{$this->tabAttribute};
            }
            $cells[] = $column->renderDataCell($model, $key, $index);
        }
        if ($this->rowOptions instanceof \Closure) {
            $options = call_user_func($this->rowOptions, $model, $key, $index, $this);
        } else {
            $options = $this->rowOptions;
        }
        $options['data-key'] = is_array($key) ? json_encode($key) : (string) $key;

        return Html::tag('tr', implode('', $cells), $options);
    }

}