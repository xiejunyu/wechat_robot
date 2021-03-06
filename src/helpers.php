<?php

use Im050\WeChat\Collection\Members;
use Im050\WeChat\Collection\MessageCollection;
use Im050\WeChat\Component\Config;
use Im050\WeChat\Component\HttpClient;
use Im050\WeChat\Core\Api;
use Im050\WeChat\Core\Application;

/*
 * 自定义快捷函数
 */

if (!function_exists('http')) {
    /**
     * 获取HTTP CLIENT
     *
     * @return \Im050\WeChat\Component\HttpClient|null
     */
    function http()
    {
        static $http = null;
        if ($http == null) {
            $http = new HttpClient();
        }
        return $http;
    }
}

if (!function_exists('app')) {
    /**
     * 获取应用容器
     *
     * @return \Im050\WeChat\Core\Application|null
     */
    function app()
    {
        return Application::getInstance();
    }
}

if (!function_exists('uri')) {
    /**
     * 获取请求地址
     *
     * @param $name
     * @return mixed|null
     */
    function uri($name)
    {
        return Api::uri($name);
    }
}

if (!function_exists('checkBaseResponse')) {
    /**
     * 校验数据是否正确返回
     *
     * @param $data
     * @return bool
     */
    function checkBaseResponse($data)
    {
        if (isset($data['BaseResponse']['Ret'])) {
            return intval($data['BaseResponse']['Ret']) == 0;
        } else {
            return false;
        }
    }
}

if (!function_exists('members')) {
    /**
     * 获取联系人列表
     *
     * @return \Im050\WeChat\Collection\Members|null
     */
    function members()
    {
        return Members::getInstance();
    }
}

if (!function_exists('config')) {
    /**
     * 获取或设置配置
     *
     * @param $param
     * @param $value
     * @param bool $force 强制重写，如果为false，则配置值存在时，不进行更改
     * @return mixed|null
     */
    function config($param, $value = '', $force = false)
    {
        $config = Config::getInstance();
        if (empty($value)) {
            return $config->get($param);
        } else {
            if (isset($config->config[$param])) {
                if ($force) {
                    $config->set($param, $value);
                } else {
                    return false;
                }
            } else {
                $config->set($param, $value);
            }
            return true;
        }
    }
}

if (!function_exists('messages')) {
    /**
     * 消息记录集合
     *
     * @return MessageCollection|null
     */
    function messages()
    {
        return MessageCollection::getInstance();
    }
}