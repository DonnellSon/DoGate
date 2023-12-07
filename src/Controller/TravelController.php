<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Travel;
use DateTimeImmutable;
use App\Entity\Thumbnail;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Api\IriConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Vich\UploaderBundle\Handler\UploadHandler;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TravelController extends AbstractController
{
    private $entityManager;
    private $uploadHandler;

    public function __construct(EntityManagerInterface $entityManager, UploadHandler $uploadHandler,private IriConverterInterface $iriConverter)
    {
        $this->entityManager = $entityManager;
        $this->uploadHandler = $uploadHandler;
    }

    public function __invoke(Request $req): Travel
    {
        $travel = new Travel();
        $requestPost = $req->request;
        $travel->setContent($requestPost->get(key: 'content'));
        if($authorIri=$requestPost->get(key: 'author')){
        $travel->setAuthor($this->iriConverter->getResourceFromIri($authorIri));

        }
        $uploadedFiles = $req->files->get('file');
        if ($uploadedFiles) {
            $i=0;
            foreach ($uploadedFiles as $uploadedFile) {
                $i=$i+500;
                $mediaObject = new Thumbnail();
                $mediaObject->setCreatedAt((new DateTimeImmutable())->modify("+$i second"));
                $mediaObject->setFile($uploadedFile);
                $travel->addThumbnail($mediaObject);
                $this->entityManager->persist($mediaObject);
                $image=new Image();
                $image->setImageEntity($mediaObject);
                $this->entityManager->persist($image);
            }
        }
        
        return $travel;
    }
}
