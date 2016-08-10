<?php

namespace Prototype\LaravelEloquent\Traits;

/**
 * Class GetCacheObjectTrait
 *
 * @package Prototype\LaravelEloquent\Traits
 */
trait GetCacheObjectTrait
{

    /**
     * @var array
     */
    protected static $cacheObjects = [];

    /**
     * @param null|string|object $class
     *
     * @return object
     */
    public static function getCacheObject($class = null)
    {
        if ($class === null) {
            $class = get_called_class();
        } elseif (is_object($class)) {
            $class = get_class($class);
        }

        if (!isset(static::$cacheObjects[$class])) {
            static::$cacheObjects[$class] = new static();
        }

        return clone static::$cacheObjects[$class];
    }
}

