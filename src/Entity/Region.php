<?php

namespace SfadlessCMF\ContentBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use IteratorAggregate;

/**
 * Region
 *
 * @ORM\Entity()
 * @ORM\Table(name="cmf__regions")
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
class Region
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
     * @var Collection
     *
     * @ORM\OneToMany(
     *     targetEntity="SfadlessCMF\ContentBundle\Entity\RegionHasBlock",
     *     mappedBy="region",
     *     cascade={"persist"},
     *     orphanRemoval=true
     * )
     * @ORM\OrderBy({"position" : "ASC"})
     */
    private $regionHasBlocks;

    /**
     * Region constructor.
     */
    public function __construct()
    {
        $this->regionHasBlocks = new ArrayCollection();
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
     * @return Region
     */
    public function setCode(string $code): Region
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
     * @return Region
     */
    public function setName(string $name): Region
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getRegionHasBlocks(): Collection
    {
        return $this->regionHasBlocks;
    }

    /**
     * @param RegionHasBlock $regionHasBlock
     */
    public function addRegionHasBlock(RegionHasBlock $regionHasBlock)
    {
        $regionHasBlock->setRegion($this);
        $this->regionHasBlocks->add($regionHasBlock);
    }

    /**
     * @param Collection $regionHasBlocks
     * @return Region
     */
    public function setRegionHasBlocks($regionHasBlocks): Region
    {
        $this->regionHasBlocks = new ArrayCollection();

        foreach ($regionHasBlocks as $regionHasBlock) {
            $this->addRegionHasBlock($regionHasBlock);
        }

        return $this;
    }

    public function removeRegionHasBlock(RegionHasBlock $regionHasBlock)
    {
        $this->regionHasBlocks->removeElement($regionHasBlock);
    }

    public function reorderRegionHasBlocks()
    {
        if ($this->regionHasBlocks && $this->regionHasBlocks instanceof IteratorAggregate) {
            // reorder
            $iterator = $this->regionHasBlocks->getIterator();

            $iterator->uasort(function ($a, $b) {
                if ($a->getPosition() === $b->getPosition()) {
                    return 0;
                }

                return $a->getPosition() > $b->getPosition() ? 1 : -1;
            });

            $this->setRegionHasBlocks($iterator);
        }
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
