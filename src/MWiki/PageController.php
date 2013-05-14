<?php

namespace MWiki;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class PageController {
    public function edit(Request $request, Application $app) {
        $title = $request->get('title');
        $page = $app['query.page']->byTitle($title);
        $body = $page ? $page->getBody() : '# Click EDIT to write something!';

        return $app['twig']->render('edit.html', array(
            'title' => $title,
            'body' => $body,
        ));
    }
}
