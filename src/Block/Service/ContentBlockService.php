<?php

namespace SfadlessCMF\ContentBundle\Block\Service;

use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\Service\AbstractBlockService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Templating\EngineInterface;

/**
 * ContentBlockService
 *
 * @author Pavel Golikov <pavel@golikov.tech>
 */
class ContentBlockService extends AbstractBlockService
{
    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver->setDefined('content');
    }

    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        return $this->renderResponse($blockContext->getTemplate(), ['content' => $blockContext->getSetting('content')]);
    }

    public function __construct(EngineInterface $templating)
    {
        parent::__construct('sfadless_cmf.content.content_block', $templating);
    }
}
