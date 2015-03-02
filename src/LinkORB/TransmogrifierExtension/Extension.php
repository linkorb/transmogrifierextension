<?php

namespace LinkORB\TransmogrifierExtension;

use Behat\Testwork\ServiceContainer\ExtensionManager;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Behat\Testwork\ServiceContainer\Extension as ExtensionInterface;

class Extension implements ExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ContainerBuilder $container, array $config)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/services'));
        $loader->load('core.xml');

        if (isset($config['dbconf_dir'])) {
            $container->setParameter('behat.transmogrifierextension.dbconf_dir', rtrim($config['dbconf_dir'], '/'));
        }

        if (isset($config['dataset_dir'])) {
            $container->setParameter('behat.transmogrifierextension.dataset_dir', rtrim($config['dataset_dir'], '/'));
        }
    }

    /**
     * Returns the extension config key.
     *
     * @return string
     */
    public function getConfigKey()
    {
        return 'transmogrifier';
    }

    /**
     * Initializes other extensions.
     *
     * This method is called immediately after all extensions are activated but
     * before any extension `configure()` method is called. This allows extensions
     * to hook into the configuration of other extensions providing such an
     * extension point.
     *
     * @param ExtensionManager $extensionManager
     */
    public function initialize(ExtensionManager $extensionManager)
    {

    }

    /**
     * Setups configuration for the extension.
     *
     * @param ArrayNodeDefinition $builder
     */
    public function configure(ArrayNodeDefinition $builder)
    {
        $builder->
            children()->
                scalarNode('dbconf_dir')->
                    defaultNull()->
                end()->
                scalarNode('dataset_dir')->
                    defaultNull()->
                end()->
            end()->
        end();
    }

    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     *
     * @api
     */
    public function process(ContainerBuilder $container)
    {
    }
}
