<?php

namespace SfadlessCMF\ContentBundle\Twig;

use SfadlessCMF\ContentBundle\Templating\Helper\ContentHelper;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * ContentExtension
 *
 * @author Pavel Golikov <pavel@golikov.tech>
 */
class ContentExtension extends AbstractExtension
{
    /**
     * @var ContentHelper
     */
    private $contentHelper;

    public function getFunctions()
    {
        return [
            new TwigFunction(
                'cmf_render_region',
                [$this->contentHelper, 'renderRegion']
            ),
            new TwigFunction(
                'cmf_render_block',
                [$this->contentHelper, 'renderBlock']
            ),
        ];
    }

    public function __construct(ContentHelper $contentHelper)
    {
        $this->contentHelper = $contentHelper;
    }
}
