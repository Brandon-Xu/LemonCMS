<?php

use yii\helpers\Html;

/* @var $this source\core\front\FrontView */
/* @var $searchModel source\models\search\ContentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $modules \source\modules\modularity\models\Modularity[] */
$type = 'post';
$this->title = '模块管理';
$this->params['breadcrumbs'][] = $this->title;


$css = <<<CSS

table.da-table tr td.da-icon-column a{margin-right:5px;}
CSS;
$this->registerCss($css);

?>

<?php $this->toolbars([
    Html::a('新建模块', ['/gii/default/view', 'id' => 'lulumodule'], [
        'class' => 'btn btn-xs btn-primary mod-site-save', 'target' => '_blank',
    ]),
]); ?>

<table class="da-table">
    <thead>
    <tr>
        <th width="90px">标识</th>
        <th width="250px">名称</th>
        <th>描述</th>
        <th width="150px"></th>
    </tr>
    </thead>
    <tbody>

    <?php foreach ($modules as $module): ?>
        <tr data-key="<?php echo $module->id ?>">
            <td><?php echo $module->id ?></td>
            <td><?php echo $module->info->name ?></td>
            <td><?php echo $module->info->description ?></td>
            <td class="da-icon-column">
                <?php if ($module->is_system) { echo '系统内置'; } ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
