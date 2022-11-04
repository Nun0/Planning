<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\BookingType;
use App\Repository\BookingRepository;
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
    public function calendar(BookingRepository $bookingRepository): Response
    {
        return $this->render('booking/calendar.html.twig', [
            'users' => array($this->getUser()),
        ]);
        /*
        return $this->render('booking/index.html.twig', [
                'bookings' => $bookingRepository->findBy(array('formateur' => $this->getUser())),
        ]);*/
    }  
}
