<?php

/**
 * AlmaviacxRestrictedSiteaccessBundle.
 *
 * @package   AlmaviaCX\RestrictedSiteaccess
 *
 * @author    AlmaviaCX
 * @copyright 2023 AlmaviaCX
 * @license   https://github.com/Novactive/AlmaviaCXRestrictedSiteAccessBundle/blob/main/LICENSE MIT Licence
 */

declare(strict_types=1);

namespace AlmaviaCX\RestrictedSiteaccess\DependencyInjection;

use Ibexa\Bundle\Core\DependencyInjection\Configuration\SiteAccessAware\ConfigurationProcessor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

final class RestrictedSiteAccessExtension extends Extension
{

    public function getAlias(): string
    {
        return Configuration::NAMESPACE;
    }

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');
        $loader->load('default_settings.yaml');
    }

}