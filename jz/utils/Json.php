<?php
// +----------------------------------------------------------------------
// | JuZi [ 🍊橘子科技🍊 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2022~2022  All rights reserved.
// +----------------------------------------------------------------------
// | Author: JuZi Team 
// +----------------------------------------------------------------------
namespace jz\utils;

use think\Response;

/**
 * Json 输出类
 */

class Json
{

    private $code = 200;

    public function code(int $code): self
    {
        $this->code = $code;
        return $this;
    }

    public function make(int $code, string $msg, ?array $data = null, ?array $replace = []): Response
    {
        $res = compact('code', 'msg');

        if (!is_null($data))
            $res['data'] = $data;

        if (is_numeric($res['msg']))
            $res['msg'] = getLang($res['msg'], $replace);

        return Response::create($res, 'json', $this->code);
    }
    public function success($msg = 'success', ?array $data = null, ?array $replace = []): Response
    {
        if (is_array($msg)) {
            $data = $msg;
            $msg = 'success';
        }

        return $this->make(200, $msg, $data, $replace);
    }

    public function fail($msg = 'fail', ?array $data = null, ?array $replace = []): Response
    {
        if (is_array($msg)) {
            $data = $msg;
            $msg = 'fail';
        }

        return $this->make(400, $msg, $data, $replace);
    }

    public function status($status, $msg, $result = [])
    {
        $status = strtoupper($status);
        if (is_array($msg)) {
            $result = $msg;
            $msg = 'success';
        }
        return app('json')->success($msg, compact('status', 'result'));
    }

}