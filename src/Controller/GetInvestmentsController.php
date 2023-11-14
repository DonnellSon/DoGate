<?php
// src/Controller/GetInvestmentsController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\InvestissementRepository;
use Symfony\Component\HttpFoundation\Request;

#[Route('/api/investissement', name: 'get_investissement')]
class GetInvestmentsController extends AbstractController
{
    private $investissementRepository;

    public function __construct(InvestissementRepository $investRepository)
    {
        $this->investissementRepository = $investRepository;
    }

    #[Route('', methods: ['GET'])]
    public function __invoke(Request $request): JsonResponse
    {
        $companyType = $request->query->get('type');

        if (!$companyType) {
            return new JsonResponse(['error' => 'Le paramètre "companyType" est manquant.'], 400);
        }

        $investments = $this->investissementRepository->findByCompanyType($companyType);

        return $this->json(['investments' => $investments]);
    }
}


