<?php

namespace Zorbus\PageBundle\Model;

use Doctrine\ORM\EntityRepository;

class PageBlockRepository extends EntityRepository {

    public function getByPageWithBlocks($pageId) {
        return $this
                        ->createQueryBuilder('pb')
                        ->join('pb.page', 'p')
                        ->join('pb.block', 'b')
                        ->where('p.id = :pageId')
                        ->setParameter('pageId', $pageId)
                        ->getQuery()
                        ->execute();
    }

}
