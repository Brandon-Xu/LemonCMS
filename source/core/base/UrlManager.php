<?php

namespace source\core\base;

use yii\web\UrlRule;

class UrlManager extends \yii\web\UrlManager
{
    public $encodeUrl = FALSE;
    private $_ruleCache;

    public function createUrl($params) {
        $params = (array)$params;
        $anchor = isset($params[ '#' ]) ? '#'.$params[ '#' ] : '';
        unset($params[ '#' ], $params[ $this->routeParam ]);

        $route = trim($params[ 0 ], '/');
        unset($params[ 0 ]);

        $baseUrl = $this->showScriptName || !$this->enablePrettyUrl ? $this->getScriptUrl() : $this->getBaseUrl();

        if ($this->enablePrettyUrl) {
            $cacheKey = $route.'?'.implode('&', array_keys($params));

            /* @var $rule UrlRule */
            $url = FALSE;
            if (isset($this->_ruleCache[ $cacheKey ])) {
                foreach ($this->_ruleCache[ $cacheKey ] as $rule) {
                    if (($url = $rule->createUrl($this, $route, $params)) !== FALSE) {
                        break;
                    }
                }
            } else {
                $this->_ruleCache[ $cacheKey ] = [];
            }

            if ($url === FALSE) {
                foreach ($this->rules as $rule) {
                    if (($url = $rule->createUrl($this, $route, $params)) !== FALSE) {
                        $this->_ruleCache[ $cacheKey ][] = $rule;
                        break;
                    }
                }
            }

            if ($url !== FALSE) {
                if (strpos($url, '://') !== FALSE) {
                    if ($baseUrl !== '' && ($pos = strpos($url, '/', 8)) !== FALSE) {
                        return substr($url, 0, $pos).$baseUrl.substr($url, $pos);
                    } else {
                        return $url.$baseUrl.$anchor;
                    }
                } else {
                    return "$baseUrl/{$url}{$anchor}";
                }
            }

            if ($this->suffix !== NULL) {
                $route .= $this->suffix;
            }
            if (!empty($params) && ($query = http_build_query($params)) !== '') {
                $route .= '?'.$query;
            }

            return "$baseUrl/{$route}{$anchor}";
        } else {
            $url = "$baseUrl?{$this->routeParam}=";

            $url .= $this->encodeUrl ? urlencode($route) : $route;

            if (!empty($params) && ($query = http_build_query($params)) !== '') {
                $url .= '&'.$query;
            }

            return $url.$anchor;
        }
    }
}
