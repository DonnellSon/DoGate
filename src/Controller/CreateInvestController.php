<?php

namespace App\Controller;

use App\Entity\Amount;
use App\Entity\Image;
use App\Entity\Invest;
use App\Entity\Company;
use App\Entity\CompanyLogo;
use App\Entity\InvestPicture;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Api\IriConverterInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;


#[AsController]
class CreateInvestController extends AbstractController
{

    private $validator;

    public function __construct(private EntityManagerInterface $entityManager, private IriConverterInterface $iriConverter, private Security $security)
    {
        $this->validator=Validation::createValidator();
    }

    public function __invoke(Request $req): Invest
    {

        $currentUser = $this->security->getUser();
        $invest = new Invest();
        $requestInvest = $req->request;
        $investAuthorIri = $requestInvest->get(key: 'author');
        $invest->setAuthor(null);
        if ($investAuthorIri) {
            try {
                $investAuthor = $this->iriConverter->getResourceFromIri($investAuthorIri);
                if ($investAuthor instanceof Company && $investAuthor->getAuthor() === $currentUser) {
                    $invest->setAuthor($investAuthor);
                }
            } catch (\Exception $e) {
                
            }
        }
        $invest->setTitle($requestInvest->get(key: 'title'));
        $invest->setDescription($requestInvest->get(key: 'description'));

        if($requestInvest->get(key: 'need') && $requestInvest->get(key: 'currency')){
            try {
                $need = new Amount();
                $need->setValue((int) $requestInvest->get(key: 'need'));
                $need->setCurrency($this->iriConverter->getResourceFromIri($requestInvest->get(key: 'currency')));
                $invest->setNeed($need);
            } catch (\Exception $e) {
    
            }
        }



        if ($requestInvest->get(key: 'collected') && $requestInvest->get(key: 'currency')) {
            try {
                $collected = new Amount();
                $collected->setValue((int) $requestInvest->get(key: 'collected'));
                $collected->setCurrency($this->iriConverter->getResourceFromIri($requestInvest->get(key: 'currency')));
                $invest->setCollected($collected);
            }catch(\Exception $e){

            }
        }
        


        $domains = $req->get('domains');
        
        if (is_array($domains) && count($domains) > 0) {
            foreach ($domains as $domain) {
                try{
                    $invest->addDomain($this->iriConverter->getResourceFromIri($domain));
                }catch(\Exception $e){
                    
                }
            }
        }

        if ($uploadedInvestPictures = $req->files->get('medias')) {
            $i = 0;
            foreach ($uploadedInvestPictures as $uploadedInvestPicture) {
                $i = $i + 500;
                $mediaObject = new InvestPicture();
                $mediaObject->setCreatedAt((new \DateTimeImmutable())->modify("+$i second"));
                $mediaObject->setFile($uploadedInvestPicture);
                $invest->addInvestPicture($mediaObject);
                $mediaObject->setInvest($invest);
                $this->entityManager->persist($mediaObject);
            }
        }
        return $invest;
    }
}
