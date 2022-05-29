<?php

declare(strict_types=1);

namespace SimpleRefreshToken\DependencyInjection;

use SimpleRefreshToken\Configuration\Configuration;
use SimpleRefreshToken\Configuration\Options\ExtractorsOption;
use SimpleRefreshToken\Configuration\Options\GeneratorClassOption;
use SimpleRefreshToken\Configuration\Options\HeaderNameOption;
use SimpleRefreshToken\Configuration\Options\ParameterNameOption;
use SimpleRefreshToken\Configuration\Options\RefreshTTLOption;
use SimpleRefreshToken\Configuration\Options\TokenClassOption;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;


/**
 * @link   http://symfony.com/doc/current/cookbook/bundles/extension.html
 * @author tcloud <tcloud.ax@gmail.com>
 * @since  v1.0.0
 */
class JsendStandartExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $configuration = new Configuration();
        $configuration = $this->processConfiguration($configuration, $configs);
        $this->defineParameters($configuration, $container);
    }

    /**
     * @param array            $configuration
     * @param ContainerBuilder $container
     * 
     * @return void
     */
    private function defineParameters(array $configuration, ContainerBuilder $container): void
    {
        $this->defineRefreshTTLParameter($configuration, $container);
        $this->defineParameterNameParameter($configuration, $container);
        $this->defineHeaderNameParameter($configuration, $container);
        $this->defineTokenClassParameter($configuration, $container);
        $this->defineGeneratorClassParameter($configuration, $container);
        $this->defineExtractorsParameter($configuration, $container);
    }

    /**
     * @param array            $configuration
     * @param ContainerBuilder $container
     * 
     * @return void
     */
    private function defineRefreshTTLParameter(array $configuration, ContainerBuilder $container): void
    {
        if (
            isset($configuration[RefreshTTLOption::OPTION_NAME]) 
            && !empty($configuration[RefreshTTLOption::OPTION_NAME])
        ) {
            $definition = $container->getDefinition('refresh_token.options.ttl');
            $definition->replaceArgument(0, $configuration[RefreshTTLOption::OPTION_NAME]);
        }
    }

    /**
     * @param array            $configuration
     * @param ContainerBuilder $container
     * 
     * @return void
     */
    private function defineParameterNameParameter(array $configuration, ContainerBuilder $container): void
    {
        if (
            isset($configuration[ParameterNameOption::OPTION_NAME]) 
            && !empty($configuration[ParameterNameOption::OPTION_NAME])
        ) {
            $definition = $container->getDefinition('refresh_token.options.parameter_name');
            $definition->replaceArgument(0, $configuration[ParameterNameOption::OPTION_NAME]);
        }
    }

    /**
     * @param array            $configuration
     * @param ContainerBuilder $container
     * 
     * @return void
     */
    private function defineHeaderNameParameter(array $configuration, ContainerBuilder $container): void
    {
        if (
            isset($configuration[HeaderNameOption::OPTION_NAME]) 
            && !empty($configuration[HeaderNameOption::OPTION_NAME])
        ) {
            $definition = $container->getDefinition('refresh_token.options.header_name');
            $definition->replaceArgument(0, $configuration[HeaderNameOption::OPTION_NAME]);
        }
    }

    /**
     * @param array            $configuration
     * @param ContainerBuilder $container
     * 
     * @return void
     */
    private function defineTokenClassParameter(array $configuration, ContainerBuilder $container): void
    {
        if (
            isset($configuration[TokenClassOption::OPTION_NAME]) 
            && !empty($configuration[TokenClassOption::OPTION_NAME])
        ) {
            $definition = $container->getDefinition('refresh_token.options.token_class');
            $definition->replaceArgument(0, $configuration[TokenClassOption::OPTION_NAME]);
        }
    }

    /**
     * @param array            $configuration
     * @param ContainerBuilder $container
     * 
     * @return void
     */
    private function defineGeneratorClassParameter(array $configuration, ContainerBuilder $container): void
    {
        if (
            isset($configuration[GeneratorClassOption::OPTION_NAME]) 
            && !empty($configuration[GeneratorClassOption::OPTION_NAME])
        ) {
            $definition = $container->getDefinition('refresh_token.options.generator_class');
            $definition->replaceArgument(0, $configuration[GeneratorClassOption::OPTION_NAME]);
        }
    }

    /**
     * @param array            $configuration
     * @param ContainerBuilder $container
     * 
     * @return void
     */
    private function defineExtractorsParameter(array $configuration, ContainerBuilder $container): void
    {
        if (
            isset($configuration[ExtractorsOption::OPTION_NAME]) 
            && !empty($configuration[ExtractorsOption::OPTION_NAME])
        ) {
            $definition = $container->getDefinition('refresh_token.options.extractors');
            $definition->replaceArgument(0, $configuration[ExtractorsOption::OPTION_NAME]);
        }
    }
}