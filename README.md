# AlmaviaCX Restricted SiteAccess Bundle

AlmaviaCX Restricted SiteAccess Bundle allows to restrict one or more siteaccess by IPs for ibexa 4 in case it is impossible to restrict by nginx/apache or .htaccess. Useful for restricting a siteaccess on platform.sh

----

## Installation

Ibexa 4.4+

### Use Composer

Add the lib to your composer.json, run `composer require almaviacx/restrictedsiteaccess` to refresh dependencies.

### Register the bundle

Then inject the bundle in the `config\bundles.php` of your application.

```php
    return [
        // ...
        AlmaviaCX\RestrictedSiteaccess\AlmaviacxRestrictedSiteaccessBundle::class => ['all' => true],
    ];
```

### Add new parameters

The values can be updated according to the project specification

```yaml
# config/packages/ibexa.yaml

parameters:
  ...
  acx_acl.default.siteaccess_controls:
    'siteaccessname':
      enabled: true
      authorized_ips:
        - 192.168.16.1
        - X.X.X.X
    'admin':
      enabled: true
      authorized_ips:
        - 192.168.16.1
        - X.X.X.X


```

