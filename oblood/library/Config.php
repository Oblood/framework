<?php

namespace oblood\library;


class Config
{

    protected static $config;

    /**
     * 读取配置项，使用方式有如下
     * get('a.b.c.d') = config[a][b][c][d],get('a') = config[a]
     * @param string $name
     * @return string|array
     */
    public static function get($name = '')
    {
        if (empty(self::$config)) {
            self::init();
        }

        if (empty($name)) {
            return self::$config;
        }

        if (isset(self::$config[$name])) {
            return self::$config[$name];
        }

        $names = explode('.', $name);
        $value = '';
        for ($i = 0; $i < count($names); $i++) {
            if ($i === 0) {
                $value = self::$config[$names[$i]];
            } else {
                $value = $value[$names[$i]];
            }
        }

        return $value;

    }

    /**
     * 动态设置配置项，
     * @param $name
     * @param $value
     */
    public static function set($name, $value)
    {
        if (empty(self::$config)) {
            self::init();
        }

        self::$config[$name] = $value;

    }

    /**
     * 初始化配置项，将所有配置文件的配置项集合放到 self::$config
     */
    protected static function init()
    {

        $configPath = BASE_ROOT
            . DIRECTORY_SEPARATOR . 'oblood'
            . DIRECTORY_SEPARATOR . 'config'
            . DIRECTORY_SEPARATOR . 'convention.php';

        $config = include $configPath;;

        $commonConfig = $config['COMMON_CONFIGS'];

        for ($i = 0; $i < count($commonConfig); $i++) {
            if (is_file($commonConfig[$i])) {
                $config = array_merge($config, include $commonConfig[$i]);
            }
        }

        $applicationConfig = $config['APPLICATION_CONFIGS'];

        for ($i = 0; $i < count($applicationConfig); $i++) {
            if (is_file($applicationConfig[$i])) {
                $t = include $applicationConfig[$i];
                if (is_array($t)) {
                    $config = array_merge($config, $t);
                }
            }

        }

        self::$config = $config;
        unset($config);
    }
}