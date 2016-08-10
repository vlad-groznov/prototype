<?php

namespace Prototype\LaravelEloquent;

use Prototype\LaravelEloquent\Traits\SetOptionsTrait;
use Prototype\LaravelEloquent\Traits\GetCacheObjectTrait;

/**
 * Class Model
 *
 * @package Prototype\LaravelEloquent
 */
class Model
{

    use GetCacheObjectTrait;
    use SetOptionsTrait;

    /**
     * @var Resolver
     */
    protected static $resolver;

    /**
     * @var Connection
     */
    protected static $connection;

    /**
     * @var string
     */
    protected $connectionName = 'default';

    /**
     * @param Resolver $resolver
     */
    public static function setResolver(Resolver $resolver)
    {
        static::$resolver = $resolver;
    }

    /**
     * @param Connection $connection
     */
    public static function setConnection(Connection $connection)
    {
        static::$connection = $connection;
    }

    /**
     * @return mixed|Connection
     * @throws \Exception
     */
    public function getConnection()
    {
        return isset(static::$connection) ? static::$connection : static::$resolver->get($this->connectionName);
    }

    /**
     * @param $name
     * @param $arguments
     *
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        /** @var static $model */
        $model = static::getCacheObject();

        return call_user_func_array([$model->getConnection(), $name], $arguments);
    }
}
