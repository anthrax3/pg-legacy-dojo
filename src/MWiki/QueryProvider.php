<?php

namespace MWiki;

use Silex\Application;
use Silex\ServiceProviderInterface;

class QueryProvider implements ServiceProviderInterface {
    public function register(Application $app) {
        $app['query.page'] = $app->share(function($app) {
            return new PageQuery($app['orm.em']);
        });
    }

    public function boot(Application $app) {
    }
}
