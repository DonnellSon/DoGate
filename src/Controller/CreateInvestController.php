<?php

namespace App\Controller;

use App\Entity\Image;
use DateTimeImmutable;
use App\Entity\Company;
use App\Entity\CompanyLogo;
use App\Entity\InvestPicture;
use App\Entity\Investissement;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Api\IriConverterInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[AsController]
class CreateInvestController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager, private IriConverterInterface $iriConverter,private Security $security)
    {
    }

    public function __invoke(Request $req): Investissement
    {
        // dd($req->files->get('investPictures'));
        $currentUser = $this->security->getUser();
        $invest = new Investissement();
        $requestInvest = $req->request;
        $investAuthorIri=$requestInvest->get(key:'author');
        if($investAuthorIri){
            $investAuthor=$this->iriConverter->getResourceFromIri($investAuthorIri);
            if($investAuthor instanceof Company && $investAuthor->getAuthor()===$currentUser){
                $invest->setAuthor($investAuthor);
            }
        }
        $invest->setTitle($requestInvest->get(key: 'title'));
        $invest->setDescription($requestInvest->get(key: 'description'));
        $invest->setNeed($requestInvest->get(key: 'need'));
        $invest->setCollected($requestInvest->get(key: 'collected'));
        

        if ($domains = $req->get('domains')) {
            foreach ($domains as $domain) {
                $invest->addDomaine($this->iriConverter->getResourceFromIri($domain));
            }
        }

        if ($uploadedInvestPictures = $req->files->get('investPictures')) {
            $i=0;
            foreach ($uploadedInvestPictures as $uploadedInvestPicture) {
                $i=$i+500;
                $mediaObject = new InvestPicture();
                $mediaObject->setCreatedAt((new \DateTimeImmutable())->modify("+$i second"));
                $mediaObject->setFile($uploadedInvestPicture);
                $invest->addInvestPicture($mediaObject);
                $mediaObject->setInvestissement($invest);
                $this->entityManager->persist($mediaObject);
            }
        }
        return $invest;
    }
}
