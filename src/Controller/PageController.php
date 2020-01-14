<?php

namespace SfadlessCMF\ContentBundle\Controller;

use SfadlessCMF\ContentBundle\Entity\Content;
use SfadlessCMF\ContentBundle\Event\PageEvents;
use SfadlessCMF\ContentBundle\Event\PageParametersEvent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\Routing\Route;

/**
 * PageController
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
class PageController extends AbstractController
{
    public function page(EventDispatcherInterface $dispatcher, Route $routeDocument)
    {
        $content = $this->getDoctrine()->getRepository(Content::class)->findOneBy(['route' => $routeDocument->getPath()]);

        $parameters = new ParameterBag();
        $dispatcher->dispatch(PageEvents::PAGE_PARAMETERS, new PageParametersEvent($content, $parameters));

        return $this->render($content->getTemplate(), [
            'content' => $content,
            'parameters' => $parameters->all()
        ]);
    }
}