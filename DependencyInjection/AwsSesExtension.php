<?php

namespace IDCI\Bundle\AwsSesBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class AwsSesExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter("aws_ses.region_endpoint", $config['region_endpoint']);
        $container->setParameter("aws_ses.message_from", $config['message_from']);
        $container->setParameter("aws_ses.secret_key", $config['secret_key']);
        $container->setParameter("aws_ses.access_key", $config['access_key']);
        $container->setParameter("aws_ses.message_to", $config['message_to']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
