<?php

namespace App\Controller;

use App\Entity\Promo;
use App\Form\PromoType;
use App\Repository\CoursRepository;
use App\Repository\PromoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/promo')]
class AdminPromoController extends AbstractController
{
    #[Route('/', name: 'app_admin_promo_index', methods: ['GET'])]
    public function index(PromoRepository $promoRepository): Response
    {
        return $this->render('admin_promo/index.html.twig', [
            'promos' => $promoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_promo_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PromoRepository $promoRepository): Response
    {
        $promo = new Promo();
        $form = $this->createForm(PromoType::class, $promo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $promoRepository->save($promo, true);

            return $this->redirectToRoute('app_admin_promo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_promo/new.html.twig', [
            'promo' => $promo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_promo_ajax', methods: ['GET'])]
    public function show_promo_by_ajax(Promo $promo, CoursRepository $coursRepo, Request $request): Response
    {   
        if( $request->isXmlHttpRequest() ){
            $cours = $coursRepo->findByPromoOrderedByAscName($promo);
            dump($cours);
            $coursPromo = [];
            foreach($cours as $key => $value){
                $coursPromo[$key]['id'] = $value->getId();
                $coursPromo[$key]['module'] = $value->getModule();
            }

            return new JsonResponse($coursPromo);
        }
        
    }

    #[Route('/{id}', name: 'app_admin_promo_show', methods: ['GET'])]
    public function show(Promo $promo): Response
    {
        return $this->render('admin_promo/show.html.twig', [
            'promo' => $promo,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_promo_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Promo $promo, PromoRepository $promoRepository): Response
    {
        $form = $this->createForm(PromoType::class, $promo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $promoRepository->save($promo, true);

            return $this->redirectToRoute('app_admin_promo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_promo/edit.html.twig', [
            'promo' => $promo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_promo_delete', methods: ['POST'])]
    public function delete(Request $request, Promo $promo, PromoRepository $promoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$promo->getId(), $request->request->get('_token'))) {
            $promoRepository->remove($promo, true);
        }

        return $this->redirectToRoute('app_admin_promo_index', [], Response::HTTP_SEE_OTHER);
    }
}
