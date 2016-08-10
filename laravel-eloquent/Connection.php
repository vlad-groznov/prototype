<?php

namespace Prototype\LaravelEloquent;

use Prototype\LaravelEloquent\Traits\SetOptionsTrait;

/**
 * Class Connection
 *
 * @package Prototype\LaravelEloquent
 */
class Connection
{

    use SetOptionsTrait;

    protected $host;

    protected $login;

    protected $password;

    /**
     * Connection constructor.
     *
     * @param array $options
     */
    public function __construct($options = [])
    {
        $this->setOptions($options);
    }

    public function __call($name, $arguments)
    {
        print_r(['class' => __CLASS__, 'method' => $name, 'arguments' => $arguments]);

        return $arguments;
    }

    public function sendRequest($data)
    {
        print_r(['class' => __CLASS__, 'method' => __FUNCTION__, 'data' => $data]);

        return $data;
    }
}
