<?php

namespace Prototype\LaravelEloquent;

use Prototype\LaravelEloquent\Traits\GlobalizeTrait;
use Prototype\LaravelEloquent\Traits\SetOptionsTrait;


/**
 * Class Manager
 *
 * @package Prototype\LaravelEloquent
 */
class Manager
{

    use GlobalizeTrait;
    use SetOptionsTrait;

    /**
     * @var Resolver
     */
    protected $resolver;

    /**
     * Manager constructor.
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }

    /**
     * @return Resolver
     */
    public function getResolver()
    {
        if ($this->resolver === null) {
            $this->resolver = new Resolver(['className' => Connection::class]);
        }

        return $this->resolver;
    }

    /**
     * @param Resolver $resolver
     *
     * @return $this
     */
    public function setResolver(Resolver $resolver)
    {
        $this->resolver = $resolver;

        return $this;
    }

    /**
     * @return $this
     */
    public function bootstrap()
    {
        Model::setResolver($this->getResolver());

        return $this;
    }

    /**
     * @param array $options
     * @param null  $name
     *
     * @return $this
     */
    public function addConnection(array $options = [], $name = null)
    {
        $this->getResolver()->add($options, $name);

        return $this;
    }
}
