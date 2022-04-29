<?php
namespace Zuogechengxu\Wechat\Kernel;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class Config extends Collection
{
    protected $items = [];

    public function __construct(array $items = [])
    {
        foreach ($items as $key => $value) {
            $this->set($key, $value);
        }
    }

    public function set($key, $value)
    {
        Arr::set($this->items, $key, $value);
    }

    public function get($key, $default = null)
    {
        return Arr::get($this->items, $key, $default);
    }

    public function forget($key)
    {
        Arr::forget($this->items, $key);
    }

    public function toJson($option = JSON_UNESCAPED_UNICODE)
    {
        return json_encode($this->all(), $option);
    }

    public function toArray()
    {
        return $this->all();
    }
}