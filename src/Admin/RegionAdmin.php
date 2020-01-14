<?php

namespace SfadlessCMF\ContentBundle\Admin;

use Doctrine\ORM\EntityManagerInterface;
use Sfadless\Cmf\Entity\Region;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * RegionAdmin
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
class RegionAdmin extends AbstractAdmin
{
    protected $baseRoutePattern = 'region';

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('code', null, ['label' => 'Символьный код'])
            ->addIdentifier('name', null, ['label' => 'Название'])
        ;
    }

    public function configureFormFields(FormMapper $form)
    {
        $form
            ->with('Настройка блоков', ['class' => 'col-md-9'])
                ->add('regionHasBlocks', CollectionType::class, ['by_reference' => false,'label' => 'Блоки'], [
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position'
                ])
            ->end()
        ;

        $form
            ->with('Общее', ['class' => 'col-md-3'])
                ->add('code', TextType::class, ['label' => 'Символьный код'])
                ->add('name', null, ['label' => 'Название'])
            ->end()
        ;
    }

    /**
     * @param $object Region
     */
    public function preUpdate($object)
    {
//        foreach ($object->getRegionHasBlocks() as $key => $regionHasBlock) {
//            $regionHasBlock->setRegion($object);
//        }
    }

    /**
     * @param $object Region
     */
    public function postUpdate($object)
    {
        $object->reorderRegionHasBlocks();
    }

    public function __construct($code, $class, $baseControllerName, EntityManagerInterface $em)
    {
        parent::__construct($code, $class, $baseControllerName);
        $this->em = $em;
    }
}