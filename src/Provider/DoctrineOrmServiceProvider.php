<?php

namespace Rcomponent\Wallet\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Driver\Mysqli\Driver;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Common\Annotations\AnnotationReader;

class DoctrineOrmServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['doctrine.metadata.driver'] = function () {
            $reader = new AnnotationReader();
            return new AnnotationDriver($reader, [
                __SRC__ . '/Entity/',
            ]);
        };

        $app['doctrine.config'] = function ( $app ) {
            $config = new Configuration();

            $config->setProxyDir( __ROOT__ . '/var/cache/dev/doctrine/orm/Proxies' );
            $config->setProxyNamespace( 'MyProject\Proxies' );
            $config->setAutoGenerateProxyClasses( false );

            $config->setMetadataDriverImpl( $app['doctrine.metadata.driver'] );
//            $config->setMetadataCacheImpl( $app['cache.array'] );
//
//            $cacheDriver = $app['cache.chain'];
//            $config->setQueryCacheImpl( $cacheDriver );
//            $config->setResultCacheImpl( $cacheDriver );
//            $config->setHydrationCacheImpl( $cacheDriver );
//
//            // this has to be on, only thing that caches Entities properly
//            $config->setSecondLevelCacheEnabled( true );
//            $config->getSecondLevelCacheConfiguration()->setCacheFactory( $app['cache.factory'] );
//
//            if ( 'dev' === $app['env'] ) {
//                $config->setSQLLogger( new SQLLogger() );
//            }
            return $config;
        };

        $app['doctrine.nyt.driver'] = function () {
            // Driver calls DriverConnection, which sets the internal _conn prop
            // to the mysqli instance from wpdb
            return new Driver();
        };

        $app['db.host'] = function () {
            return '127.0.0.1';
            //return getenv( 'DB_HOST' );
        };

        $app['db.user'] = function () {
            return 'root';
            //return getenv( 'DB_USER' );
        };

        $app['db.password'] = function () {
            return '123456';
            //return getenv( 'DB_PASSWORD' );
        };

        $app['db.name'] = function () {
            return 'wallet';
            //return getenv( 'DB_NAME' );
        };

        $app['doctrine.connection'] = function ( $app ) {
            return new Connection(
            // these credentials don't actually do anything
                [
                    'host' => $app['db.host'],
                    'user' => $app['db.user'],
                    'password' => $app['db.password'],
                    'dbname' => $app['db.name']
                ],
                $app['doctrine.nyt.driver'],
                $app['doctrine.config']
            );
        };

        $app['entityManager'] = function ( $app ) {
            $conn = $app['doctrine.connection'];
            return EntityManager::create( $conn, $app['doctrine.config'], $conn->getEventManager() );
        };
    }
}