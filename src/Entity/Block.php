<?php

namespace SfadlessCMF\ContentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Block
 *
 * @ORM\Entity()
 * @ORM\Table(name="cmf__blocks")
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
class Block
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="code", nullable=false, unique=true)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="name", nullable=false, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="template", nullable=true)
     */
    private $template;

    /**
     * @var string
     *
     * @ORM\Column(type="text", name="content", nullable=true)
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="provider")
     */
    private $provider;

    /**
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Block
     */
    public function setContent(string $content): Block
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string
     */
    public function getProvider(): ?string
    {
        return $this->provider;
    }

    /**
     * @param string $provider
     * @return Block
     */
    public function setProvider(string $provider): Block
    {
        $this->provider = $provider;
        return $this;
    }

    /**
     * @return string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return Block
     */
    public function setCode(string $code): Block
    {
        $this->code = $code;
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
     * @return Block
     */
    public function setName(string $name): Block
    {
        $this->name = $name;
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
     * @return Block
     */
    public function setTemplate(string $template): Block
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->code ?? "Block";
    }
}
