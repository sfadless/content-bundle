<?php

namespace SfadlessCMF\ContentBundle\Event;

use SfadlessCMF\ContentBundle\Entity\Content;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * PageParametersEvent
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
class PageParametersEvent extends Event
{
    /**
     * @var Content
     */
    private $content;

    /**
     * @var ParameterBag
     */
    private $parameters;

    /**
     * PageParametersEvent constructor.
     * @param Content $content
     * @param ParameterBag $parameters
     */
    public function __construct(Content $content, ParameterBag $parameters)
    {
        $this->content = $content;
        $this->parameters = $parameters;
    }

    /**
     * @return Content
     */
    public function getContent(): Content
    {
        return $this->content;
    }

    /**
     * @return ParameterBag
     */
    public function getParameters(): ParameterBag
    {
        return $this->parameters;
    }
}