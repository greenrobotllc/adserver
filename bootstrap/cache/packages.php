<?php return array (
  'fideloper/proxy' => 
  array (
    'providers' => 
    array (
      0 => 'Fideloper\\Proxy\\TrustedProxyServiceProvider',
    ),
  ),
  'laravel/tinker' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Tinker\\TinkerServiceProvider',
    ),
  ),
  'nesbot/carbon' => 
  array (
    'providers' => 
    array (
      0 => 'Carbon\\Laravel\\ServiceProvider',
    ),
  ),
  'stancl/tenancy' => 
  array (
    'providers' => 
    array (
      0 => 'Stancl\\Tenancy\\TenancyServiceProvider',
    ),
    'aliases' => 
    array (
      'Tenant' => 'Stancl\\Tenancy\\Facades\\TenantFacade',
      'Tenancy' => 'Stancl\\Tenancy\\Facades\\TenancyFacade',
      'GlobalCache' => 'Stancl\\Tenancy\\Facades\\GlobalCacheFacade',
    ),
  ),
  'torann/geoip' => 
  array (
    'providers' => 
    array (
      0 => 'Torann\\GeoIP\\GeoIPServiceProvider',
    ),
    'aliases' => 
    array (
      'GeoIP' => 'Torann\\GeoIP\\Facades\\GeoIP',
    ),
  ),
);