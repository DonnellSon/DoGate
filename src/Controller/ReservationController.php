<?php

// src/Controller/ReservationController.php
namespace App\Controller;

use App\Entity\Reservation;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

#[ApiResource]
class ReservationController
{
    private $entityManager;

//    public function __construct(EntityManagerInterface $entityManager)
//    {
//        $this->entityManager = $entityManager;
//    }

//    private function transformToArray(Reservation $reservation): array
//     {
//        return [
//            'id' => $reservation->getId(),
//            'user' => $reservation->getUser()->getId(),
//            'company' => $reservation->getCompany()->getName(),
//            'travel' => $reservation->getTravel()->getAuthor(),
//        ];
//     }

//     #[Get]
//     public function list(): Response
//     {
       
//        $reservations = $this->entityManager->getRepository(Reservation::class)->findAll();
  
//         // Convert the reservations to an array
//         $reservationsArray = [];
//         foreach ($reservations as $reservation) {
//             $reservationsArray[] = $this->transformToArray($reservation);
//         }
  
//         return new JsonResponse($reservationsArray);
//     }

//     #[Get]
//     public function show(Reservation $reservation): Response
//     {
//         return new JsonResponse($this->transformToArray($reservation));
//     }
  
//     #[Post]
//     public function create(Request $request, EntityManagerInterface $entityManager): Response
//     {
//        $data = json_decode($request->getContent(), true);
    
//        $reservation = new Reservation();
//        $reservation->setUser($data['user']);
//        $reservation->setCompany($data['company']);
//        $reservation->setTravel($data['travel']);
    
//        $entityManager->persist($reservation);
//        $entityManager->flush();
    
//        return new JsonResponse($this->transformToArray($reservation), Response::HTTP_CREATED);
//     }

//     #[Put]
//     public function update(Reservation $reservation, Request $request, EntityManagerInterface $entityManager): Response
//     {
//         $data = json_decode($request->getContent(), true);
  
//         $reservation->setUser($data['user']);
//         $reservation->setCompany($data['company']);
//         $reservation->setTravel($data['travel']);
  
//         $entityManager->persist($reservation);
//         $entityManager->flush();
  
//         return new JsonResponse($this->transformToArray($reservation));
//     }
  

//     #[Delete]
//     public function delete(Reservation $reservation, EntityManagerInterface $entityManager): Response
//     {
//       $entityManager->remove($reservation);
//       $entityManager->flush();
    
//       return new Response('', Response::HTTP_NO_CONTENT);
//     }
    
  
}
