<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Amount;
use App\Entity\Invest;
use App\Entity\Company;
use App\Entity\JobGrade;
use App\Entity\JobOffer;
use App\Entity\CompanyLogo;
use App\Entity\ExactSalary;
use App\Entity\JobType;
use App\Entity\RangeSalary;
use App\Entity\InvestPicture;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Api\IriConverterInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Validator\Validation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


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
      
            try {
                $author = $this->iriConverter->getResourceFromIri($authorIri);
                if ($author instanceof Company && $author->getAuthor() === $currentUser) {
                    $jobOffer->setAuthor($author);
                }
            } catch (\Exception $e) {

            }
        
        $jobOffer->setTitle($postedJob->get('title'))
            ->setDescription($postedJob->get('description'))
            ->setSummary($postedJob->get('summary'));



        try {
            $grade=$this->iriConverter->getResourceFromIri($postedJob->get('grade'));
            if ($grade instanceof JobGrade) {
                $jobOffer->setGrade($grade);
            }
        } catch (\Exception $e) {
        }

        try {
            $type=$this->iriConverter->getResourceFromIri($postedJob->get('type'));
            if($type instanceof JobType)
            $jobOffer->setType($type);
        } catch (\Exception $e) {

        }
        $postedSalary=$postedJob->get('salary') ? json_decode($postedJob->get('salary')) : null;
        if ($postedSalary && $postedSalary->min && $postedSalary->max) {
            $salary = new RangeSalary();
            $salary->setCurrency($this->iriConverter->getResourceFromIri($postedSalary->currency))
                ->setMin($postedSalary->min)
                ->setMax(($postedSalary->max));
            $jobOffer->setSalary($salary);
        } elseif ($postedSalary && $postedSalary->amount) {
            $salary = new ExactSalary();
            $salary->setCurrency($this->iriConverter->getResourceFromIri($postedSalary->currency))
                ->setExactAmount($postedSalary->amount);
                $jobOffer->setSalary($salary);
        }
        return $jobOffer;
    }
}
