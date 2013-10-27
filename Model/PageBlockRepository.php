<?php

namespace Zorbus\PageBundle\Model;

use Doctrine\ORM\EntityRepository;

abstract class PageBlockRepository extends EntityRepository {

    public function getByPageIdWithBlocks($pageId) {
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
