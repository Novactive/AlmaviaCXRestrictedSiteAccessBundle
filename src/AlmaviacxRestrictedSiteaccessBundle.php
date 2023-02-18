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

namespace AlmaviaCX\RestrictedSiteaccess;

use LogicException;
use AlmaviaCX\RestrictedSiteaccess\DependencyInjection\RestrictedSiteAccessExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class AlmaviacxRestrictedSiteaccessBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);
    }

    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $extension = new RestrictedSiteAccessExtension();
            if (!$extension instanceof ExtensionInterface) {
                $fqdn = \get_class($extension);
                $message = 'Extension %s must implement %s.';
                throw new LogicException(sprintf($message, $fqdn, ExtensionInterface::class));
            }
            $this->extension = $extension;
        }

        return $this->extension;
    }
}