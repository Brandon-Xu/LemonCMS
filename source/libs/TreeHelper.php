<?php

namespace source\libs;

class TreeHelper
{
    public static function buildTreeOptionsForSelf($treeArray, $model = NULL) {
        $options = '<option value="0">根节点</option>';

        $found = FALSE;;

        foreach ($treeArray as $row) {
            $theId = intval($row[ 'id' ]);
            $style = '';

            if ($model != NULL) {
                if ($model[ 'parent_id' ] == $theId) {
                    $style = ' selected';
                }
                if ($model[ 'id' ] === $theId) {
                    $model[ 'level' ] = intval($row[ 'level' ]);
                    $found = TRUE;
                    continue;
                }
                if ($found) {
                    if (intval($row[ 'level' ]) > $model[ 'level' ]) {
                        continue;
                    } else {
                        $found = FALSE;
                    }
                }
            }

            $options .= '<option value="'.$row[ 'id' ].'"'.$style.'>'.str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',
                    $row[ 'level' ]).$row[ 'name' ].'</option>';
        }

        return $options;
    }

    public static function buildTreeOptions($treeArray) {
        $options = [];
        foreach ($treeArray as $row) {
            $options[ $row[ 'id' ] ] = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $row[ 'level' ]).$row[ 'name' ];
        }

        return $options;
    }

    public static function getParentIds($class, $parentId) {
        $_parentIds = [];
        $parent = $class::findOne(['id' => $parentId]);
        while ($parent !== NULL) {
            array_unshift($_parentIds, $parent->id);
            $parent = $class::findOne(['id' => $parent->parent_id]);
        }

        return $_parentIds;
    }

    public static function getChildrenIds($class, $id) {
        $_childrenIds = [];
        $children = $class::findAll(['parent_id' => $id]);
        //var_dump($children[0]);
        //return $_childrenIds;
        while (count($children) > 0) {
            $first = array_shift($children);
            $_childrenIds[] = $first->id;

            $next = $class::findAll(['parent_id' => $first->id]);
            if (count($next) > 0) {
                $children = array_merge($children, $next);
            }
        }

        return $_childrenIds;
    }

}