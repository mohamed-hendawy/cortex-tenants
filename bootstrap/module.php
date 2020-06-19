<?php

declare(strict_types=1);

return function () {
    // Discover and set current active tenant. We need `request.tenant` as early as we can, since
    // it's used in bootable traits, routes, and other resources called in service providers!
    $subdomain = strstr($this->app->request->getHost(), '.'.domain(), true);
    $tenant = app('rinvex.tenants.tenant')->where('slug', (string) $subdomain)->first();
    $this->app->singleton('request.subdomain', fn() => $subdomain);
    $this->app->singleton('request.tenant', fn() => $tenant);
};
