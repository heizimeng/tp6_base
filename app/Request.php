<?php
namespace app;

// 应用请求对象类
use Spatie\Macroable\Macroable;

class Request extends \think\Request
{
    use Macroable;

    /**
     * 不过滤变量名
     * @var array
     */
    protected $except = [];

    /**
     * 获取请求的数据
     * @param array $params  参数
     * @param bool $suffix  // [] =  xxx (解构) 需要设置true 直接返回 参数值不为数组时 得为true
     * @param bool $filter   是否过滤
     * @return array
     */
    public function more(array $params, bool $suffix = false,  bool $filter = true): array
    {
        $p = [];
        $i = 0;
        foreach ($params as $param) {
            if (!is_array($param)) {
                $p[$suffix == true ? $i++ : $param] = $this->filterWord(is_string($this->param($param)) ? trim($this->param($param)) : $this->param($param), $filter && !in_array($param, $this->except));
            } else {
                if (!isset($param[1])) $param[1] = null;
                if (!isset($param[2])) $param[2] = '';
                if (is_array($param[0])) {
                    $name = is_array($param[1]) ? $param[0][0] . '/a' : $param[0][0] . '/' . $param[0][1];
                    var_dump($name);
                    $keyName = $param[0][0];
                } else {
                    $name = is_array($param[1]) ? $param[0] . '/a' : $param[0];

                    $keyName = $param[0];
                }
                //[['pid', 0, '', 'cid']]  参数数组为3个， 第四个值会替换第0个
                $p[$suffix == true ? $i++ : ($param[3] ?? $keyName)] = $this->filterWord(is_string($this->param($name, $param[1], $param[2])) ? trim($this->param($name, $param[1], $param[2])) : $this->param($name, $param[1], $param[2]), $filter && !in_array($keyName, $this->except));
            }
        }
        return $p;
    }

    /**
     * 过滤接受的参数
     * @param string $str 需要过滤得参数
     * @param bool $filter 是否过滤
     * @return array|mixed|string|string[]
     */
    public function filterWord($str, bool $filter = true)
    {
        if (!$str || !$filter) return $str;
        // 把数据过滤
        $farr = [
            "/<(\\/?)(script|i?frame|style|html|body|title|link|meta|object|\\?|\\%)([^>]*?)>/isU",
            "/(<[^>]*)on[a-zA-Z]+\s*=([^>]*>)/isU",
            "/select|join|where|drop|like|modify|rename|insert|update|table|database|alter|truncate|\'|\/\*|\.\.\/|\.\/|union|into|load_file|outfile/is"
        ];
        if (is_array($str)) {
            foreach ($str as &$v) {
                if (is_array($v)) {
                    foreach ($v as &$vv) {
                        if (!is_array($vv)) $vv = preg_replace($farr, '', $vv);
                    }
                } else {
                    $v = preg_replace($farr, '', $v);
                }
            }
        } else {
            $str = preg_replace($farr, '', $str);
        }
        return $str;
    }

    /**
     * 获取get参数
     * @param array $params
     * @param bool $suffix
     * @param bool $filter
     * @return array
     */
    public function getMore(array $params, bool $suffix = false, bool $filter = true): array
    {
        return $this->more($params, $suffix, $filter);
    }

    /**
     * 获取post参数
     * @param array $params
     * @param bool $suffix
     * @param bool $filter
     * @return array
     */
    public function postMore(array $params, bool $suffix = false, bool $filter = true): array
    {
        return $this->more($params, $suffix, $filter);
    }


}
