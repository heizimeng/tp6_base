<?php
// +----------------------------------------------------------------------
// | JuZi [ 🍊橘子科技🍊 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2022~2022  All rights reserved.
// +----------------------------------------------------------------------
// | Author: JuZi Team 
// +----------------------------------------------------------------------
namespace jz\exceptions;

/**
 * Class AuthException
 * @package jz\exceptions
 */
class AdminException extends \RuntimeException
{
    public function __construct($message, $replace = [], $code = 0, \Throwable $previous = null)
    {
        if (is_array($message)) {
            $errInfo = $message;
            $message = $errInfo[1] ?? '未知错误';
            if ($code === 0) {
                $code = $errInfo[0] ?? 400;
            }
        }
        if (is_numeric($message)) {
            $code = $message;
            $message = getLang($message, $replace);
        }
        parent::__construct($message, $code, $previous);
    }
}