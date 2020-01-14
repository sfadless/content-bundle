<?php

namespace SfadlessCMF\ContentBundle\Entity\Traits;

/**
 * EntityIdTrait
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
trait EntityIdTrait
{
    /**
     * @var integer
     *
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @return int
     */
    public function getId(): ? int
    {
        return $this->id;
    }
}
