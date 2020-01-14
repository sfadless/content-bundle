<?php

namespace SfadlessCMF\ContentBundle\Block\ContentProvider;

/**
 * Metadata
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
class Metadata
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $icon;

    /**
     * @var string
     */
    private $name;

    /**
     * Metadata constructor.
     * @param string $code
     * @param string $icon
     * @param string $name
     */
    public function __construct(string $code, string $icon, string $name)
    {
        $this->code = $code;
        $this->icon = $icon;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {
        return $this->icon;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
