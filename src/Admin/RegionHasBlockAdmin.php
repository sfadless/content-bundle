<?php

namespace SfadlessCMF\ContentBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

/**
 * RegionHasBlockAdmin
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
class RegionHasBlockAdmin extends AbstractAdmin
{
    public function configureFormFields(FormMapper $form)
    {
        $form
            ->add('block', ModelListType::class, ['required' => false])
            ->add('position', HiddenType::class)
        ;
    }
}