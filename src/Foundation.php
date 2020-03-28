<?php

namespace Rcomponent\Wallet;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\ORM\EntityManager;
use Pimple\Container;
use Rcomponent\Wallet\Provider\DoctrineOrmServiceProvider;

defined('__SRC__') || define('__SRC__', dirname(__DIR__) . '/src');
defined('__ROOT__') || define('__ROOT__', dirname(__DIR__));

$loader = require dirname(__DIR__).'/vendor/autoload.php';
AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

class Foundation
{
    private $container = null;
    private $providers = [];

    /**
     * @var EntityManager
     */
    public $entityManager;

    public function __construct()
    {
        $this->container = new Container();
        $this->setProviders();
        $this->registerProviders();

        $this->entityManager = $this->container->offsetGet('entityManager');
    }

    private function setProviders()
    {
        $this->providers = [
            DoctrineOrmServiceProvider::class,
        ];
    }

    private function registerProviders()
    {
        foreach ($this->providers as $provider) {
            $this->container->register(new $provider());
        }
    }

    public function __get($id) {
        return $this->container->offsetGet($id);
    }

    /**
     * @param $obj object|array
     * @return false|string
     */
    public function json($obj) {
        return json_encode($obj);
    }
}