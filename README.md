Zorbus Page Bundle
==================

In app/config.yml
-----------------

Add configuration to load the page router.

cmf_routing:
    chain:
        routers_by_id:
            zorbus.page.router: 300
            router.default: 100

Add configuration to point to the entities, replacing the interface. They should extend the provided models.

doctrine:
    orm:
        resolve_target_entities:
            Zorbus\PageBundle\Model\PageInterface: Zorbus\ZorbusBundle\Entity\Page
            Zorbus\PageBundle\Model\PageBlockInterface: Zorbus\ZorbusBundle\Entity\PageBlock
            Zorbus\BlockBundle\Model\BlockInterface: Zorbus\ZorbusBundle\Entity\Block

The entity repositories must extend the provided ones in the model.

zorbus_page:
    entities:
        page: ZorbusZorbusBundle:Page
        page_block: ZorbusZorbusBundle:PageBlock

In app/routing_dev.yml
----------------------

zorbus_page:
    resource: "@ZorbusPageBundle/Resources/Controller"
    type: annotation
    prefix: /