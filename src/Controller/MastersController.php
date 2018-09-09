<?php

namespace App\Controller;

use App\Entity\Master;
use App\Repository\MasterRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class MastersController extends FOSRestController
{

    private $em;
    private $masterRepository;

    public function __construct(MasterRepository $masterRepository, EntityManagerInterface $em)
    {
        $this->masterRepository = $masterRepository;
        $this->em = $em;
    }

    public function getMastersAction()
    {
        $masters = $this->masterRepository->findAll();
        return $this->view($masters);
    }

    public function getMasterAction($id)
    {
    } // "get_user" [GET] /masters/{id}

    /**
     * @Rest\Post("/masters")
     * @ParamConverter("master", converter="fos_rest.request_body")
     */
    public function postMastersAction(Master $master)
    {
        $this->em->persist($master);
        $this->em->flush();
        return $this->view($master);
    }
    public function putMasterAction($id)
    {
    } // "put_user" [PUT] /masters/{id}

    public function deleteMasterAction($id)
    {
    } // "delete_user" [DELETE] /masters/{id}
}
