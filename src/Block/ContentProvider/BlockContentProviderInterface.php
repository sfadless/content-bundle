<?php

namespace SfadlessCMF\ContentBundle\Block\ContentProvider;

use SfadlessCMF\ContentBundle\Entity\Block;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * BlockContentProviderInterface
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
interface BlockContentProviderInterface
{
    public function getMetadata() : Metadata;

    public function configureFormFields(FormMapper $mapper, Block $object);

    public function getBlockType() : string;
}
