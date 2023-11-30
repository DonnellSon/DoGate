<?php

namespace App\Controller;

use App\Entity\Amount;
use App\Entity\ExactSalary;
use App\Entity\Image;
use App\Entity\Invest;
use App\Entity\Company;
use App\Entity\CompanyLogo;
use App\Entity\InvestPicture;
use App\Entity\JobOffer;
use App\Entity\RangeSalary;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Api\IriConverterInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;


#[AsController]
class CreateJobOfferController extends AbstractController
{

    private $validator;

    public function __construct(private EntityManagerInterface $entityManager, private IriConverterInterface $iriConverter, private Security $security)
    {
        $this->validator = Validation::createValidator();
    }

    public function __invoke(Request $req): JobOffer
    {

        $currentUser = $this->security->getUser();
        $postedJob = $req->request;
        $authorIri = $postedJob->get(key: 'author');



        $jobOffer = new JobOffer();
        if ($authorIri) {
            $author = $this->iriConverter->getResourceFromIri($authorIri);
            if ($author instanceof Company && $author->getAuthor() === $currentUser) {
                $jobOffer->setAuthor($author);
            }
        }
        $jobOffer->setTitle($postedJob->get('title'))
            ->setDescription($postedJob->get('description'))
            ->setSummary($postedJob->get('summary'))
            ->setGrade($this->iriConverter->getResourceFromIri($postedJob->get('grade')))
            ->setType($this->iriConverter->getResourceFromIri($postedJob->get('type')));
        if ($postedJob->get('salary') && $postedJob->get('salary')->min && $postedJob->get('salary')->max) {
            $salary = new RangeSalary();
            $salary->setCurrency($postedJob->get('salary')->currency)
                ->setMin($postedJob->get('salary')->min)
                ->setMax(($postedJob->get('salary')->max))
                ->setSalary($salary);
        } elseif ($postedJob->get('salary') && $postedJob->get('salary')->amount) {
            $salary = new ExactSalary();
            $salary->setCurrency($postedJob->get('salary')->currency)
                ->setExactAmount($postedJob->get('salary')->amount);
        }
        return $jobOffer;
    }
}
