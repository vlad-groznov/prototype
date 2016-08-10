<?php

namespace Prototype\LaravelEloquent\Traits;

/**
 * Class GlobalizeTrait
 *
 * @package Prototype\LaravelEloquent\Traits
 */
trait GlobalizeTrait
{

    /**
     * @var static
     */
    protected static $instance;

    /**
     * @param $name
     * @param $arguments
     *
     * @return mixed
     * @throws \Exception
     */
    public static function __callStatic($name, $arguments)
    {
        if (static::$instance === null) {
            $class = get_called_class();
            throw new \Exception("{$class} is not defined as global. Please globalize it!");
        }

        return call_user_func_array([static::$instance, $name], $arguments);
    }

    /**
     * @return $this
     */
    public function globalize()
    {
        static::$instance = $this;

        return $this;
    }
}
