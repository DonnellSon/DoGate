<?php

namespace App\Controller;

use App\Entity\FileResource;
use App\Entity\Image;
use App\Entity\Post;
use App\Entity\Thumbnail;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Vich\UploaderBundle\Handler\UploadHandler;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;


#[AsController]
class PostController extends AbstractController
{
    private $entityManager;
    private $uploadHandler;

    public function __construct(EntityManagerInterface $entityManager, UploadHandler $uploadHandler)
    {
        $this->entityManager = $entityManager;
        $this->uploadHandler = $uploadHandler;
    }

    public function __invoke(Request $req): Post
    {
        $post = new Post();
        $requestPost = $req->request;
        $post->setContent($requestPost->get(key: 'content'));
        $uploadedFiles = $req->files->get('file');
        if ($uploadedFiles) {
            $i=0;
            foreach ($uploadedFiles as $uploadedFile) {
                $i=$i+500;
                $mediaObject = new Thumbnail();
                $mediaObject->setCreatedAt((new \DateTimeImmutable())->modify("+$i second"));
                $mediaObject->setFile($uploadedFile);
                $post->addThumbnail($mediaObject);
                $this->entityManager->persist($mediaObject);
                $image=new Image();
                $image->setImageEntity($mediaObject);
                $this->entityManager->persist($image);
            }
        }
        
        return $post;
    }
}
