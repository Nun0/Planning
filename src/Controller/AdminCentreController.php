<?php

namespace App\Controller;

use App\Entity\Centre;
use App\Form\CentreType;
use App\Repository\CentreRepository;
use App\Repository\PromoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/dashboard')]
class AdminCentreController extends AbstractController
{
    #[Route('/', name: 'app_admin_centre_index', methods: ['GET'])]
    public function index(CentreRepository $centreRepository): Response
    {
        return $this->render('admin_centre/index.html.twig', [
            'centres' => $centreRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_centre_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CentreRepository $centreRepository): Response
    {
        $centre = new Centre();
        $form = $this->createForm(CentreType::class, $centre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $centreRepository->save($centre, true);

            return $this->redirectToRoute('app_admin_centre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_centre/new.html.twig', [
            'centre' => $centre,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'app_admin_centre_ajax', methods: ['GET'])]
    public function show_centre_by_ajax(Centre $centre, PromoRepository $promoRepo, Request $request): Response
    {   
        if( $request->isXmlHttpRequest() ){
            $promos = $promoRepo->findByCentreOrderedByAscName($centre);

            $promoCentre = [];
            foreach($promos as $key => $value){
                $promoCentre[$key]['id'] = $value->getId();
                $promoCentre[$key]['nom'] = $value->getNom();
            }

            return new JsonResponse($promoCentre);
        }
        
    }

    #[Route('/{id}', name: 'app_admin_centre_show', methods: ['GET'])]
    public function show(Centre $centre): Response
    {
        return $this->render('admin_centre/show.html.twig', [
            'centre' => $centre,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_centre_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Centre $centre, CentreRepository $centreRepository): Response
    {
        $form = $this->createForm(CentreType::class, $centre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $centreRepository->save($centre, true);

            return $this->redirectToRoute('app_admin_centre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_centre/edit.html.twig', [
            'centre' => $centre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_centre_delete', methods: ['POST'])]
    public function delete(Request $request, Centre $centre, CentreRepository $centreRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$centre->getId(), $request->request->get('_token'))) {
            $centreRepository->remove($centre, true);
        }

        return $this->redirectToRoute('app_admin_centre_index', [], Response::HTTP_SEE_OTHER);
    }
}
