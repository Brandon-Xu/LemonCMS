<?php

namespace source\libs;

use yii\helpers\ArrayHelper;

/**
 * ChannelController implements the CRUD actions for Channel model.
 */
class Constants
{

    const TabSize = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

    public static function getSortNum() {
        return time();
    }

    const YES = 1;
    const NO  = 0;

    /**
     * @param null $key
     * @return array
     */
    public static function getYesNoItems($key = NULL) {
        $items = [
            self::YES => '是', self::NO => '否',
        ];
        if($key === NULL) return $items;
        return ArrayHelper::getValue($items, $key);
    }

    const ENABLE = 1;
    const DISABLE= 0;

    /**
     * @param null $key
     * @return array
     */
    public static function getStatusItems($key = NULL) {
        $items = [
            self::ENABLE => '可用', self::DISABLE => '禁用',
        ];
        if($key === NULL) return $items;
        return ArrayHelper::getValue($items, $key);
    }

    const SELF = '_self';
    const BLANK = '_blank';

    /**
     * @param null $key
     * @return array
     */
    public static function getTargetItems($key = NULL) {
        $items = [
            self::SELF => '当前窗口', self::BLANK => '新窗口',
        ];
        if($key === NULL) return $items;
        return ArrayHelper::getValue($items, $key);
    }

    const Visibility_Public = '1';
    const Visibility_Hidden = '2';
    const Visibility_Password = '3';
    const Visibility_Private = '4';

    /**
     * @param null $key
     * @return array
     */
    public static function getVisibilityItems($key = NULL) {
        $items = [
            self::Visibility_Public => '公开', self::Visibility_Hidden => '回复可见', self::Visibility_Password => '密码保护',
            self::Visibility_Private => '私有',
        ];
        if($key === NULL) return $items;
        return ArrayHelper::getValue($items, $key);
    }

    const Status_Publish = '1';
    const Status_Draft = '2';
    const Status_Pending = '3';

    /**
     * @param null $key
     * @return array
     */
    public static function getStatusItemsForContent($key = NULL) {
        $items = [
            self::Status_Publish => '发布', self::Status_Draft => '草稿', self::Status_Pending => '等待审核',
        ];
        if($key === NULL) return $items;
        return ArrayHelper::getValue($items, $key);
    }

    /**
     * @param null $key
     * @return array
     */
    public static function getRecommendItems($key = NULL) {
        $items = [
            // 0 => '无',
            1 => '一级推荐', 2 => '二级推荐', 3 => '三级推荐', 4 => '四级推荐', 5 => '五级推荐', 6 => '六级推荐', 7 => '七级推荐', 8 => '八级推荐',
            9 => '九级推荐',
        ];
        if($key === NULL) return $items;
        return ArrayHelper::getValue($items, $key);
    }

    /**
     * @param null $key
     * @return array
     */
    public static function getHeadlineItems($key = NULL) {
        $items = [
            // 0 => '无',
            1 => '一级头条', 2 => '二级头条', 3 => '三级头条', 4 => '四级头条', 5 => '五级头条', 6 => '六级头条', 7 => '七级头条', 8 => '八级头条',
            9 => '九级头条',
        ];
        if($key === NULL) return $items;
        return ArrayHelper::getValue($items, $key);
    }

    /**
     * @param null $key
     * @return array
     */
    public static function getStickyItems($key = NULL) {
        $items = [
            // 0 => '无',
            1 => '一级置顶', 2 => '二级置顶', 3 => '三级置顶', 4 => '四级置顶', 5 => '五级置顶', 6 => '六级置顶', 7 => '七级置顶', 8 => '八级置顶',
            9 => '九级置顶',
        ];
        if($key === NULL) return $items;
        return ArrayHelper::getValue($items, $key);
    }

}
