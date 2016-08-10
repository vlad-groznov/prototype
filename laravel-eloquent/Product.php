<?php

namespace Prototype\LaravelEloquent;

/**
 * Class Product
 *
 * @package Prototype\LaravelEloquent
 */
class Product extends Model
{

    protected $connectionName = 'default';

    public static function create($data)
    {

        return static::sendRequest($data);
    }
}


