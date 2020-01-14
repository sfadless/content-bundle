<?php

namespace SfadlessCMF\ContentBundle\Entity\Menu;

use Doctrine\ORM\Mapping as ORM;
use SfadlessCMF\ContentBundle\Entity\Content;
use SfadlessCMF\ContentBundle\Entity\Traits\EntityIdTrait;
use Prodigious\Sonata\MenuBundle\Model\MenuItem as BaseMenuItem;

/**
 * MenuItem
 *
 * @ORM\Entity()
 * @ORM\Table(name="cmf__menu_items")
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
class MenuItem extends BaseMenuItem
{
    use EntityIdTrait;

    /**
     * @var Content
     *
     * @ORM\ManyToOne(targetEntity="\SfadlessCMF\ContentBundle\Entity\Content")
     * @ORM\JoinColumn(name="content_id", referencedColumnName="id")
     */
    protected $content;

    /**
     * @return Content
     */
    public function getContent(): ?Content
    {
        return $this->content;
    }

    /**
     * @param Content $content
     * @return MenuItem
     */
    public function setContent(Content $content = null): MenuItem
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string
     */
    public function getRoute()
    {
        return $this->getContent() ? $this->getContent()->getRoute() : $this->getUrl();
    }
}
