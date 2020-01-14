<?php

namespace SfadlessCMF\ContentBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Content
 *
 * @ORM\Entity()
 * @ORM\Table(name="cmf__content")
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
class Content
{
    /**
     * @var integer
     *
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="route", unique=true)
     */
    private $route;

    /**
     * @var string
     *
     * @ORM\Column(type="text", name="content", nullable=true)
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(type="text", name="template", nullable=false)
     */
    private $template;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="\SfadlessCMF\ContentBundle\Entity\Tag", cascade={"all"})
     * @ORM\JoinTable(name="cmf__content_tags",
     *     joinColumns={@ORM\JoinColumn(name="post_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")}
     * )
     */
    private $tags;

    /**
     * @var DateTime
     *
     * @ORM\Column(type="date", name="created_at", nullable=true)
     */
    private $createdAt;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="title", nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="description", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="keywords", nullable=true)
     */
    private $keywords;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", name="show_in_sitemap")
     */
    private $showInSitemap;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->createdAt = new DateTime();
        $this->position = 1;
        $this->showInSitemap = true;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): ? DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     * @return Content
     */
    public function setCreatedAt(DateTime $createdAt): Content
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getTemplate(): ?string
    {
        return $this->template;
    }

    /**
     * @param string $template
     * @return Content
     */
    public function setTemplate(string $template): Content
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRoute(): ?string
    {
        return $this->route;
    }

    /**
     * @param string $route
     * @return Content
     */
    public function setRoute(string $route): Content
    {
        $this->route = $route;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Content
     */
    public function setContent(string $content): Content
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    /**
     * @param Tag $tag
     * @return $this
     */
    public function addTag(Tag $tag)
    {
        $this->tags->add($tag);

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Content
     */
    public function setName(string $name): Content
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @param int $position
     * @return Content
     */
    public function setPosition(int $position): Content
    {
        $this->position = $position;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Content
     */
    public function setTitle(string $title): Content
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Content
     */
    public function setDescription(string $description): Content
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    /**
     * @param string $keywords
     * @return Content
     */
    public function setKeywords(string $keywords): Content
    {
        $this->keywords = $keywords;
        return $this;
    }

    /**
     * @return bool
     */
    public function isShowInSitemap(): bool
    {
        return $this->showInSitemap;
    }

    /**
     * @param bool $showInSitemap
     * @return Content
     */
    public function setShowInSitemap(bool $showInSitemap): Content
    {
        $this->showInSitemap = $showInSitemap;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}