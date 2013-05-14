<?php

namespace MWiki;

use Doctrine\ORM\EntityManager;

class PageQuery {
    public function __construct(EntityManager $em) {
        $this->repo = $em->getRepository('MWiki\Entity\Page');
    }

    public function byTitle($title) {
        return $this->repo->findOneBy(array('title' => $title));
    }
}
