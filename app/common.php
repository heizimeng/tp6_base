<?php
// 应用公共文件


use think\facade\Config;

if (!function_exists("getLang")){
    /**
     * @param $code
     * @param array $replace 替换内容
     * @return string
     */
    function getLang($code, array $replace = []){

        $config = Config::get('lang');
        $request = app()->request;

        //获取接口传入的语言类型
        if (!$range = $request->header('jz-lang')) {
            $range = $request->cookie($config['cookie_var']);
        }

        //如果找到当前语言类型，默认中文
        $langData = array_values($config['accept_language']);
        if (!in_array($range, $langData)) {
            $range = 'zh_cn';
        }

        $lang = include $config['extend_list'][$range];

        //获取返回文字
        $message = (string)($lang[$code] ?? 'Code Error');

        //替换变量
        if (!empty($replace) && is_array($replace)) {
            // 关联索引解析
            $key = array_keys($replace);
            foreach ($key as &$v) {
                $v = "{:{$v}}";
            }
            $message = str_replace($key, $replace, $message);
        }

        $message = '';
        return $message;
    }
}