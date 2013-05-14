<?php

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;

$app = new Silex\Application(array(
    'debug' => true
));

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/views',
));

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'   => 'pdo_sqlite',
        'path'     => __DIR__ . '/mwiki.db',
    ),
));

$app->register(new Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider, array(
    "orm.proxies_dir" => "cache/proxies",
    "orm.auto_generate_proxies" => true,
    "orm.em.options" => array(
        "mappings" => array(
            array(
                "type" => "annotation",
                "namespace" => "MWiki\Entity",
                "path" => __DIR__ . "/src/MWiki/Entity",
            ),
        ),
    ),
));

$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

$app->get('/', function() use($app) {
    return $app->redirect('/Welcome');
});

$app->get('/{title}', function($title) use($app) {
    $em = $app['orm.em'];
    $page = $em->getRepository('MWiki\Entity\Page')->findOneBy(array('title' => $title));

    if (is_null($page)) {
        $page = new MWiki\Entity\Page();
        $page->setTitle($title);
        $page->setBody('# Click EDIT to write something!');
    }

    return $app['twig']->render('show.html', array(
        'title' => $page->getTitle(),
        'body' => $page->getBody(),
    ));
})->bind('show');

$app->put('/{title}', function(Request $request) use ($app) {
    $em = $app['orm.em'];
    $title = $request->get('title');
    $body = $request->get('body');

    $page = $em->getRepository('MWiki\Entity\Page')->findOneBy(array('title' => $title));

    if (is_null($page)) {
        $page = new MWiki\Entity\Page();
    }

    $page->setTitle($title);
    $page->setBody($body);

    $em->persist($page);
    $em->flush();

    return $app->redirect($app['url_generator']->generate('show', array('title' => $title)));
})->bind('update');

$app->get('/{title}/edit', function($title) use ($app) {
    $em = $app['orm.em'];
    $page = $em->getRepository('MWiki\Entity\Page')->findOneBy(array('title' => $title));
    $body = $page ? $page->getBody() : '# Click EDIT to write something!';

    return $app['twig']->render('edit.html', array(
        'title' => $title,
        'body' => $body,
    ));
})->bind('edit');

Request::enableHttpMethodParameterOverride();
return $app;
