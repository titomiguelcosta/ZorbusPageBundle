Zorbus Page Bundle
==================

In app/config.yml
-----------------

Enable the cmf routing and the doctrine bundles on AppKernel.php:

public function registerBundles()
{
    $bundles = array(
        ...,
        new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
        new Symfony\Cmf\Bundle\RoutingBundle\CmfRoutingBundle(),
    );
}

Add configuration to load the page router.

cmf_routing:
    chain:
        routers_by_id:
            zorbus.page.router: 300
            router.default: 100

Add configuration to enable the doctrine extensions:

stof_doctrine_extensions:
    default_locale: %locale%
    orm:
        default:
            timestampable: true
            sluggable: true
            tree: true
            sortable: true

Add configuration to point to the entities, replacing the interface. They should extend the provided models.

doctrine:
    orm:
        resolve_target_entities:
            Zorbus\PageBundle\Model\PageInterface: Acme\DemoBundle\Entity\Page
            Zorbus\PageBundle\Model\PageBlockInterface: Acme\DemoBundle\Entity\PageBlock
            Zorbus\BlockBundle\Model\BlockInterface: Acme\DemoBundle\Entity\Block

The entity repositories must extend the provided ones in the model.

zorbus_page:
    entities:
        page: Acme\DemoBundle:Page
        page_block: Acme\DemoBundle:PageBlock
        block: Acme\DemoBundle:Block

In app/routing.yml
------------------

zorbus_page:
    resource: "@ZorbusPageBundle/Controller"
    type: annotation
    prefix: /