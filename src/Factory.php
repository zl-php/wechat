<?php
namespace Zuogechengxu\Wechat;

class Factory
{
    public static function make($method, array $config)
    {
        $namespace = \Illuminate\Support\Str::studly($method);
        $application = "\\Zuogechengxu\\Wechat\\{$namespace}\\Application";

        return new $application($config);
    }

    public static function __callStatic($method, $arguments)
    {
        return self::make($method, ...$arguments);
    }
}