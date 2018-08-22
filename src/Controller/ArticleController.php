<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\RequestBodyParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Annotation\Groups;


class ArticleController extends FOSRestController
{

    private $articleRepository;
    private $em;

    /**
     * @Groups("Article")
     * @ORM\id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    public function __construct(ArticleRepository $articleRepository, EntityManagerInterface $em)
    {
        $this->articleRepository = $articleRepository;
        $this->em = $em;
    }

    /**
     * @Rest\View(serializerGroups={"Article"})
     */
    public function getArticlesAction(){
        $articles = $this->articleRepository->findAll();
        return $this->view($articles);
    }

    public function getArticleAction(Article $article){
        return $this->view($article);
    }

    public function postArticleAction(Article $article){
        $this->em->persist($article);
        $this->em->flush();
        return $this->view($article);
    }

    public function putArticleAction(Request $request, int $id){
        $apikey = $request->headers->get('AUTH-TOKEN');
        $id_user = $request->headers->get('id');


        //$user = $this->articleRepository->findOneBy(['user_id' => ]);


    }

}
