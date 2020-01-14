<?php

namespace SfadlessCMF\ContentBundle\Templating\Helper;

use Doctrine\ORM\EntityManagerInterface;
use InvalidArgumentException;
use SfadlessCMF\ContentBundle\Block\ContentProvider\ContentProviderManager;
use SfadlessCMF\ContentBundle\Entity\Block;
use Sonata\BlockBundle\Templating\Helper\BlockHelper;

/**
 * ContentHelper
 *
 * @author Pavel Golikov <pavel@golikov.tech>
 */
class ContentHelper
{
    /**
     * @var BlockHelper
     */
    private $blockHelper;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function renderBlock($code, array $options = [])
    {
        $block = $this->em->getRepository(Block::class)->findOneBy(['code' => $code]);

        if (! $block instanceof Block) {
            throw new InvalidArgumentException(sprintf("Block by code `%s` not found", $code));
        }

        return $this->blockHelper->render(['type' => $block->getProvider()], ['template' => $block->getTemplate(), 'content' => $block->getContent()]);
    }

    public function renderRegion($code)
    {
        return '123';
    }

    public function __construct(BlockHelper $blockHelper, ContentProviderManager $contentProviderManager, EntityManagerInterface $em)
    {
        $this->blockHelper = $blockHelper;
        $this->em = $em;
    }
}
