<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\BookingType;
use App\Repository\BookingRepository;
use App\Repository\CentreRepository;
use App\Repository\PromoRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/planning')]
class BookingFormateurController extends AbstractController
{
    #[Route('/', name: 'app_booking_formateur', methods: ['GET'])]
    public function calendar(BookingRepository $bookingRepository, CentreRepository $cr): Response
    {
        return $this->render('booking/calendar_formateur.html.twig', [
            'user' => $this->getUser(),
            'centres' => $cr->findAll(),
        ]);
        /*
        return $this->render('booking/index.html.twig', [
                'bookings' => $bookingRepository->findBy(array('formateur' => $this->getUser())),
        ]);*/
    }

    #[Route('/{id}', name: 'app_booking_show', methods: ['GET'])]
    public function show(Booking $booking): Response
    {
        return $this->render('booking/show_formateur.html.twig', [
            'booking' => $booking,
        ]);
    }
}
