<?php

namespace Prototype\LaravelEloquent\Traits;

/**
 * Class SetOptionsTrait
 *
 * @package Prototype\LaravelEloquent\Traits
 */
trait SetOptionsTrait
{

    /**
     * @param array $options
     * @param bool  $exception
     *
     * @throws \Exception
     */
    public function setOptions(array $options = [], $exception = true)
    {
        foreach ($options as $property => $value) {
            $method = 'set' . ucfirst($property);
            if (method_exists($this, $method)) {
                $this->$method($value);
            } elseif (property_exists($this, $property)) {
                $this->{$property} = $value;
            } elseif ($exception) {
                throw new \Exception("Cant find method '{$method}' or property '{$property}' to setup it!");
            }
        }
    }
}
