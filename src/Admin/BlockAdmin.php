<?php

namespace SfadlessCMF\ContentBundle\Admin;

use SfadlessCMF\ContentBundle\Block\ContentProvider\ContentProviderManager;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * BlockAdmin
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
class BlockAdmin extends AbstractAdmin
{
    protected $baseRoutePattern = 'block';
    /**
     * @var ContentProviderManager
     */
    private $contentProviderManager;

    public function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('code', null, ['label' => 'Символьный код'])
            ->addIdentifier('name', null, ['label' => 'Название'])
            ->add('_action', null, [
                'label' => 'Действия',
                'actions' => [
                    'delete' => [],
                    'content' => [
                        'route' => 'content',
                        'template' => '/admin/CRUD/content.twig'
                    ]
                ]
            ])
        ;
    }

    public function configureFormFields(FormMapper $form)
    {
        $subject = $this->getSubject();
        $provider = $this->contentProviderManager->get($subject->getProvider());

        $form
            ->add('code', TextType::class, ['label' => 'Символьный код'])
            ->add('name', TextType::class, ['label' => 'Название'])
            ->add('template', TextType::class, ['label' => 'Шаблон', 'required' => false])
            ->add('provider', HiddenType::class)
        ;

        $provider->configureFormFields($form, $subject);
    }

    public function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('code', null, ['label' => 'Символьный код'])
            ->add('name', null, ['label' => 'Название'])
        ;
    }

    public function getNewInstance()
    {
        $block =  parent::getNewInstance();

        if ($this->getRequest()->isMethod('POST')) {
            $uniqid = $this->getUniqid();

            $block->setProvider($this->getRequest()->get($uniqid)['provider']);
        } else {
            $block->setProvider($this->getRequest()->get('provider'));
        }

        return $block;
    }

    public function __construct($code, $class, $baseControllerName, ContentProviderManager $contentProviderManager)
    {
        parent::__construct($code, $class, $baseControllerName);
        $this->contentProviderManager = $contentProviderManager;
    }
}
