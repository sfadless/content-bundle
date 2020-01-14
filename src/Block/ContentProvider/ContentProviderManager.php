<?php

namespace SfadlessCMF\ContentBundle\Block\ContentProvider;

use SfadlessCMF\ContentBundle\Block\Exception\BlockContentProviderNotFoundException;
use SfadlessCMF\ContentBundle\Block\Exception\DuplicateBlockContentProviderCodeException;

/**
 * ContentProviderManager
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
class ContentProviderManager
{
    /**
     * @var BlockContentProviderInterface[]
     */
    private $providers = [];

    /**
     * @param BlockContentProviderInterface $provider
     * @param string $code
     * @throws DuplicateBlockContentProviderCodeException
     */
    public function add(BlockContentProviderInterface $provider, string $code)
    {
        if (isset($this->providers[$code])) {
            throw new DuplicateBlockContentProviderCodeException(
                sprintf("Block content provider with code %s already exists.", $code)
            );
        }

        $this->providers[$code] = $provider;
    }

    /**
     * @param $code
     * @return BlockContentProviderInterface
     * @throws BlockContentProviderNotFoundException
     */
    public function get($code) : BlockContentProviderInterface
    {
        if (! isset($this->providers[$code])) {
            throw new BlockContentProviderNotFoundException(
                sprintf("Content provider with code `%s` does not exist", $code)
            );
        }

        return $this->providers[$code];
    }

    /**
     * @return BlockContentProviderInterface[]
     */
    public function getAll()
    {
        return $this->providers;
    }
}
