<?php
/**
 * Created by PhpStorm.
 * User: Rizvane
 * Date: 20/08/2018
 * Time: 11:50
 */

namespace App\Controller;


use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Annotation\Groups;

class UsersController extends FOSRestController
{

    private $userRepository;
    private $em;

    /**
     * @Groups("user")
     * @ORM\id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    public function __construct(UserRepository $userRepository, EntityManagerInterface $em)
    {
        $this->userRepository = $userRepository;
        $this->em = $em;
    }

    /**
     * @Rest\View(serializerGroups={"User"})
     */
    public function getUsersAction()
    {
        $users = $this->userRepository->findAll();
        return $this->view($users);
    } // "get_users" [GET] /users

    public function getUserAction(User $user)
    {
        return $this->view($user);
    } // "get_user" [GET] /users/{id}

    /**
     * @Rest\Post("/users")
     * @ParamConverter("user", converter="fos_rest.request_body")
     */
    public function postUsersAction(User $user)
    {
        $this->em->persist($user);
        $this->em->flush();
        return $this->view($user);

    } // "post_users" [POST] /users

    public function putUserAction(Request $request, int $id)
    {
        $user = $this->userRepository->find($id); // Ceci esr la personne qu'on modifie.

        if($user->getId() == $this->getUser()->getId() || in_array("ROLE_ADMIN", $this->getUser()->getRoles()) ){
            $firstname = $request->get('firstname');
            $lastname = $request->get('lastname');
            $email = $request->get('email');

            $user->setFirstname($firstname);
            $user->setLastname($lastname);
            $user->setEmail($email);

            $this->em->persist($user);
            $this->em->flush();

            return $this->view($user);
        }else{
            return $this->view("Vous ne pouvez pas modifier cet utilisateur.");
        }

    } // "put_user" [PUT] /users/{id}

    public function deleteUserAction($id)
    {
        $user = $this->userRepository->find($id);
        $this->em->remove($user);
        $this->em->flush();
        return $this->view($user);

    } // "delete_user" [DELETE] /users/{id}
}