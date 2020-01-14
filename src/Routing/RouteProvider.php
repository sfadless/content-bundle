<?php

namespace SfadlessCMF\ContentBundle\Routing;

use Doctrine\ORM\EntityManager;
use SfadlessCMF\ContentBundle\Entity\Content;
use Symfony\Cmf\Component\Routing\RouteProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

/**
 * RouteProvider
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
class RouteProvider implements RouteProviderInterface
{
    /**
     * @var EntityManager
     */
    private $em;

    public function getRouteCollectionForRequest(Request $request)
    {
        $collection = new RouteCollection();

        $pathInfo = $request->getPathInfo();
        $contents = $this->em->getRepository(Content::class)->findBy(['route' => $request->getPathInfo()]);

        foreach ($contents as $content) {
            $collection->add('page_' . $content->getId(), new Route($pathInfo));
        }

        return $collection;
    }

    public function getRouteByName($name)
    {
        // TODO: Implement getRouteByName() method.
    }

    public function getRoutesByNames($names)
    {
        return [];
    }

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
}