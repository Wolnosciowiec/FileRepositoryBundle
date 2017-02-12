<?php

namespace Wolnosciowiec\FileRepositoryBundle\DependencyInjection\Compiler;

use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\Serializer\Serializer;

class CacheCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $config = $container->getExtensionConfig('file_repository');

        if (!isset($config[0]['url'])
            || !isset($config[0]['token'])
            || !isset($config[0]['cache_class'])) {
            throw new InvalidConfigurationException('Missing file_repository.url, file_repository.token or file_repository.cache_class configuration');
        }

        // inject the cache service into the HTTP client
        $httpClient = $container->getDefinition('wolnosciowiec.file_repository.client');

        $httpClient->addMethodCall('setUrl',        [$config[0]['url']]);
        $httpClient->addMethodCall('setToken',      [$config[0]['token']]);
    }
}
