<?php

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use MWiki\PageController;

class PageControllerTest extends PHPUnit_Framework_TestCase {
    public function setUp() {
        $this->query = $this->getMockBuilder('MWiki\PageQuery')
            ->disableOriginalConstructor()
            ->getMock();

        $this->page = $this->getMockBuilder('MWiki\Entity\Page')
            ->disableOriginalConstructor()
            ->getMock();

        $this->twig = $this->getMockBuilder('Twig_Environment')
                     ->disableOriginalConstructor()
                     ->getMock();

        $this->app = new Silex\Application(array(
            'query.page' => $this->query,
            'twig' => $this->twig,
        ));


        $this->controller = new PageController();
        $this->request = new Request();
    }

    public function testEditNewPage() {
        $expectedTitle = 'title';
        $expectedBody = '# Click EDIT to write something!';
        $expectedResponse = new Response();

        $this->request->request->set('title', $expectedTitle);

        $this->query->expects($this->once())
            ->method('byTitle')
            ->with($expectedTitle)
            ->will($this->returnValue(null));

        $this->twig->expects($this->once())
            ->method('render')
            ->with('edit.html', array('title' => $expectedTitle, 'body' => $expectedBody))
            ->will($this->returnValue($expectedResponse));

        $actualResponse = $this->controller->edit($this->request, $this->app);

        $this->assertEquals($expectedResponse, $actualResponse);
    }

    public function testEditExistingPage() {
        $expectedTitle = 'title';
        $expectedBody = 'existing page content';
        $expectedResponse = new Response();

        $this->request->request->set('title', $expectedTitle);

        $this->query->expects($this->once())
            ->method('byTitle')
            ->with($expectedTitle)
            ->will($this->returnValue($this->page));

        $this->page->expects($this->once())
            ->method('getBody')
            ->will($this->returnValue($expectedBody));

        $this->twig->expects($this->once())
            ->method('render')
            ->with('edit.html', array('title' => $expectedTitle, 'body' => $expectedBody))
            ->will($this->returnValue($expectedResponse));

        $actualResponse = $this->controller->edit($this->request, $this->app);

        $this->assertEquals($expectedResponse, $actualResponse);
    }
}
