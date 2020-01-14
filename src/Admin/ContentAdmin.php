<?php

namespace SfadlessCMF\ContentBundle\Admin;

use Norzechowicz\AceEditorBundle\Form\Extension\AceEditor\Type\AceEditorType;
use SfadlessCMF\ContentBundle\Entity\Content;
use SfadlessCMF\ContentBundle\Entity\Tag;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\Form\Type\DatePickerType;
use Sonata\Form\Validator\ErrorElement;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * ContentAdmin
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
class ContentAdmin extends AbstractAdmin
{
    protected $baseRoutePattern = 'content/content';

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->add('tree', 'tree')
        ;
    }

    public function configureFormFields(FormMapper $form)
    {
        $form
            ->tab("Общее")
                ->with('Основные настройки', [
                    'class'       => 'col-md-8',
                    'box_class'   => 'box box-solid box-primary',
                ])
                    ->add('name', TextType::class, ['label' => 'Название'])
                    ->add('content', CKEditorType::class, ['label' => 'Контент'])
                ->end()
                ->with('Дополнительные настройки', [
                    'class'       => 'col-md-4',
                    'box_class'   => 'box box-solid box-primary',
                ])
                    ->add('template', ChoiceType::class, ['label' => 'Шаблон', 'choices' => $this->getPageTemplates(), 'empty_data' => ''])
                    ->add('route', TextType::class, [
                        'label' => 'Настройки Url',
                    ])
                    ->add('createdAt', DatePickerType::class, ['label' => 'Дата создания', 'format' => 'YYYY-MM-dd'])
                    ->add('tags',  ModelType::class, [
                        'required' => false,
                        'multiple' => true,
                        'class' => Tag::class,
                        'property' => 'name',
                        'label' => 'Теги',
                        'btn_add' => "Добавить",
                        'btn_delete' => true
                    ])
                ->end()
            ->end()
            ->tab('SEO')
                ->with('SEO', [
                    'box_class'   => 'box box-solid box-primary',
                ])
                    ->add('title', TextType::class, ['label' => 'Title', 'required' => false])
                    ->add('description', TextareaType::class, ['label' => 'Description', 'required' => false])
                    ->add('keywords', TextareaType::class, ['label' => 'Keywords', 'required' => false])
                    ->add('showInSitemap', CheckboxType::class, ['label' => 'Отображать в sitemap.xml', 'required' => false])
                ->end()
            ->end()
            ->tab('Дополнительно')
                ->with("Javascript", [
                    'class'       => 'col-md-6',
                    'box_class'   => 'box box-solid box-primary',
                ])
                    ->add('javascript', AceEditorType::class, [
                        'mapped' => false,
                        'required' => false,
                        'wrapper_attr' => array(), // aceeditor wrapper html attributes.
                        'width' => '100%',
                        'height' => 250,
                        'font_size' => 12,
                        'mode' => 'ace/mode/javascript', // every single default mode must have ace/mode/* prefix
                        'theme' => 'ace/theme/monokai', // every single default theme must have ace/theme/* prefix
                        'tab_size' => null,
                        'read_only' => null,
                        'use_soft_tabs' => null,
                        'use_wrap_mode' => null,
                        'show_print_margin' => null,
                        'show_invisibles' => null,
                        'highlight_active_line' => null,
                        'options_enable_basic_autocompletion' => true,
                        'options_enable_live_autocompletion' => true,
                        'options_enable_snippets' => false,
                        'keyboard_handler' => null,
                        'label' => 'Дополнительный Javascript на странице'
                    ])
                ->end()
                ->with("CSS", [
                    'class'       => 'col-md-6',
                    'box_class'   => 'box box-solid box-primary',
                ])
                    ->add('css', AceEditorType::class, [
                        'mapped' => false,
                        'required' => false,
                        'wrapper_attr' => array(), // aceeditor wrapper html attributes.
                        'width' => '100%',
                        'height' => 250,
                        'font_size' => 12,
                        'mode' => 'ace/mode/css', // every single default mode must have ace/mode/* prefix
                        'theme' => 'ace/theme/monokai', // every single default theme must have ace/theme/* prefix
                        'tab_size' => null,
                        'read_only' => null,
                        'use_soft_tabs' => null,
                        'use_wrap_mode' => null,
                        'show_print_margin' => null,
                        'show_invisibles' => null,
                        'highlight_active_line' => null,
                        'options_enable_basic_autocompletion' => true,
                        'options_enable_live_autocompletion' => true,
                        'options_enable_snippets' => false,
                        'keyboard_handler' => null,
                        'label' => 'Дополнительный css на странице'
                    ])
                ->end()
            ->end()
        ;
    }

    public function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('tags')
        ;
    }

    /**
     * @param ErrorElement $errorElement
     * @param $object Content
     */
    public function validate(ErrorElement $errorElement, $object)
    {
        if ('' === $object->getTemplate()) {
            $errorElement->addViolation('Не выбран шаблон');
        }
    }

    /**
     * @return array
     */
    protected function getPageTemplates()
    {
        $templates = $this->getConfigurationPool()->getContainer()->getParameter('cmf.page.templates');
        $choices = ['Выберите' => ''];

        foreach ($templates as $template) {
            $choices[$template['name']] = $template['path'];
        }

        return $choices;
    }

    public function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('name', null, ['label' => 'Название'])
            ->addIdentifier('route', null, ['label' => 'Url'])
            ->add('tags', null, ['associated_property' => 'name', 'label' => 'Теги'])
        ;
    }
}