<?php

namespace Zorbus\PageBundle\Model;

use Doctrine\ORM\EntityRepository;

class PageRepository extends EntityRepository {

    public function getBlocksByPageId($pageId) {
        $pageBlocks = $this
                ->getEntityManager()
                ->createQuery('SELECT pb FROM :entityName pb JOIN pb.page p JOIN pb.block b WHERE p.id=:pageId ORDER BY pb.location ASC, pb.position ASC')
                ->setParameter('entityName', $this->getEntityName())
                ->setParameter('pageId', $pageId)
                ->getResult();

        $blocks = array();
        foreach ($pageBlocks as $pageBlock) {
            $blocks[$pageBlock->getSlot()][] = $pageBlock->getBlock();
        }

        return $blocks;
    }

}
