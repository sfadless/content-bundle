<?php

namespace SfadlessCMF\ContentBundle\Block\Service;

use Prodigious\Sonata\MenuBundle\Manager\MenuManager;
use SfadlessCMF\ContentBundle\Entity\Menu\Menu;
use SfadlessCMF\ContentBundle\Exception\MenuNotFoundException;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\Service\AbstractBlockService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Templating\EngineInterface;

/**
 * MenuBlockService
 *
 * @author Pavel Golikov <pavel@golikov.tech>
 */
class MenuBlockService extends AbstractBlockService
{
    /**
     * @var MenuManager
     */
    private $menuManager;

    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired('menu')
            ->setDefault('template', '@SfadlessCMFContent/block/menu_block.twig');
    }

    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $menuAlias = $blockContext->getSetting('menu');
        $menu = $this->menuManager->loadByAlias($menuAlias);

        if (! $menu instanceof Menu) {
            throw new MenuNotFoundException(
                sprintf("Menu %s not found", $menuAlias)
            );
        }

        return $this->renderResponse($blockContext->getTemplate(), ['menu' => $menu]);
    }

    public function __construct(EngineInterface $templating, MenuManager $menuManager)
    {
        parent::__construct('sfadless_cmf.content.menu_block', $templating);
        $this->menuManager = $menuManager;
    }
}
