<?php

namespace SfadlessCMF\ContentBundle\Controller;

use Sonata\MediaBundle\Controller\MediaAdminController as BaseMediaAdminController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Twig\Error\RuntimeError;

/**
 * MediaAdminController.
 *
 * Adds browser and upload actions to Media entity.
 * Adapt from original CoopTilleulsCKEditorSonataMediaBundle
 */
class MediaAdminController extends BaseMediaAdminController {
    /**
     * Alter create Media action.
     *
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request = null) {
        $this->admin->checkAccess('create');

        if (!$request->get('provider') && $request->isMethod('get')) {
            $pool = $this->get('sonata.media.pool');
            return $this->render('@SonataMedia/MediaAdmin/select_provider.html.twig', [
                'providers' => $pool->getProvidersByContext(
                    $request->get('context', $pool->getDefaultContext())
                ),
                'action' => 'create',
            ]);
        }

        return parent::createAction($request);
    }

    /**
     * @return Response
     * @throws RuntimeError
     */
    public function browserAction() {
        if (false === $this->admin->isGranted('LIST')) {
            throw new AccessDeniedException();
        }

        $datagrid = $this->admin->getDatagrid();
        $datagrid->setValue('context', null, $this->admin->getPersistentParameter('context'));
        $datagrid->setValue('providerName', null, $this->admin->getPersistentParameter('provider'));
        $formats = [];
        foreach ($datagrid->getResults() as $media) {
            $formats[$media->getId()] = $this->get('sonata.media.pool')->getFormatNamesByContext($media->getContext());
        }

        $formView = $datagrid->getForm()->createView();
        $twig = $this->get('twig');
        $twig->getRuntime('Symfony\Component\Form\FormRenderer')->setTheme($formView, $this->admin->getFilterTheme());

        return $this->render('admin/media/browser.html.twig', [
            'action'    => 'browser',
            'form'      => $formView,
            'datagrid'  => $datagrid,
            'formats'   => $formats,
            'base_template' => 'admin/media/layout.html.twig',
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function uploadAction() {
        if (false === $this->admin->isGranted('CREATE')) {
            throw new AccessDeniedException();
        }

        $request = $this->getRequest();
        $provider = $request->get('provider');
        $file = $request->files->get('upload');

        if (!$request->isMethod('POST') || !$provider || null === $file) {
            throw $this->createNotFoundException();
        }

        $mediaManager = $this->get('sonata.media.manager.media');
        $media = $mediaManager->create();
        $media->setBinaryContent($file);
        $context = $request->get('context', $this->get('sonata.media.pool')->getDefaultContext());
        $mediaManager->save($media, $context, $provider);
        $this->admin->createObjectSecurity($media);

        return new JsonResponse([
            'uploaded'   => 1,
            'fileName'   => $media->getName(),
            'url'        => $this->get($media->getProviderName())->generatePublicUrl($media, 'reference')
        ]);
    }
}