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

use Ibexa\Bundle\Core\DependencyInjection\Configuration\SiteAccessAware\Configuration as SAConfiguration;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Configuration extends SAConfiguration
{
    public const NAMESPACE = 'acx_acl';

    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder(self::NAMESPACE);

        return $treeBuilder;
    }
}