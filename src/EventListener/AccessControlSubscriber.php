<?php

declare(strict_types=1);

namespace AlmaviaCX\RestrictedSiteaccess\EventListener;

use AlmaviaCX\RestrictedSiteaccess\DependencyInjection\Configuration;
use Exception;
use Ibexa\Contracts\Core\SiteAccess\ConfigResolverInterface;
use Ibexa\Core\MVC\Symfony\SiteAccess;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\IpUtils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;

class AccessControlSubscriber implements EventSubscriberInterface
{
    private ConfigResolverInterface $configResolver;
    private Environment $twig;
    private SiteAccess $siteAccess;

    public function __construct(ConfigResolverInterface $configResolver, Environment $twig, SiteAccess $siteAccess)
    {
        $this->configResolver = $configResolver;
        $this->twig = $twig;
        $this->siteAccess = $siteAccess;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => [['onKernelRequest', 10],],
        ];
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $acxControls = (array) $this->configResolver->getParameter('siteaccess_controls', 'acx_acl');
        if (!empty($acxControls)) {
            $siteaccess = $this->siteAccess->name;

            if (!array_key_exists($siteaccess, $acxControls)) {
                return;
            }
            $hostControls = (array) $acxControls[$siteaccess];
            $isEnabled = $hostControls['enabled']?? false;
            if ($isEnabled !== true) {
                return;
            }
            $authorizedIps = (array)($hostControls['authorized_ips']?? []);
            if (in_array('REMOTE_ADDR', $authorizedIps) && isset($_SERVER['REMOTE_ADDR'])) {
                $authorizedIps[] = $request->server->get('REMOTE_ADDR');
            }
            if (IpUtils::checkIp($event->getRequest()->getClientIp(), $authorizedIps)) {
                return;
            }
            try {
                $content = $this->twig->render(
                    '@ibexadesign/account/acx_siteaccess_controls_denied.html.twig',
                    [
                    ]
                );
            } catch (Exception $exception) {
                $content = 'access denied';
            }
            $event->setResponse((new Response($content))->setPrivate());
        }
    }

}