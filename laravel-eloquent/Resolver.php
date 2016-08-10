<?php

namespace Prototype\LaravelEloquent;

use Prototype\LaravelEloquent\Traits\SetOptionsTrait;

/**
 * Class Resolver
 *
 * @package Prototype\LaravelEloquent
 */
class Resolver
{

    use SetOptionsTrait;

    /**
     * @var string
     */
    protected $className;

    /**
     * @var array
     */
    protected $instances = [];

    /**
     * @var array
     */
    protected $options = [];

    /**
     * Resolver constructor.
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }

    /**
     * @param string|null $name
     *
     * @return string
     */
    protected function resolveName($name)
    {
        return ($name === null) ? 'default' : $name;
    }

    /**
     * @param null|string $name
     *
     * @return mixed
     * @throws \Exception
     */
    public function get($name)
    {
        $name = $this->resolveName($name);

        if (!isset($this->options[$name]) && !isset($this->instances[$name])) {
            throw new \Exception("Connection with name '{$name}' is undefined!");
        }

        if (!isset($this->instances[$name])) {
            $this->instances[$name] = new $this->className($this->options[$name]);
        }

        return $this->instances[$name];
    }

    /**
     * @param array|object $mixed
     * @param string|null  $name
     *
     * @return $this
     */
    public function add($mixed, $name)
    {
        $name = $this->resolveName($name);

        if (is_object($mixed)) {
            $this->instances[$name] = $mixed;
        } else {
            $this->options[$name] = $mixed;
        }

        return $this;
    }

    /**
     * @param string|null $name
     *
     * @return boolean
     */
    public function has($name)
    {
        $name = $this->resolveName($name);

        return isset($this->options[$name]) || isset($this->instances[$name]);
    }
}


