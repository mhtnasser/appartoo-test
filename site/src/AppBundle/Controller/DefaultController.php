<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Extraterrestre;
use AppBundle\Form\ExtraterrestreType;
use AppBundle\Manager\ExtraterrestreManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    private $manager;

    public function __construct(ExtraterrestreManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("/", name="homepage")
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig', []);
    }

    /**
     * listUserAction
     *
     * @Route("/all_user", name="List_user")
     */
    public function listUserAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $reponse = new JsonResponse();
        return $reponse->setData($this->manager->withoutCurrentUser($user));
    }

    /**
     * myFriendsAction
     *
     * @Route("/my_friends", name="friends_page")
     */
    public function myFriendsAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $reponse = new JsonResponse();
        return $reponse->setData($this->manager->withoutCurrentFriends($user));
    }

    /**
     * @Route("/addFriend/{userId}", name="user_friend", requirements={"userId" = "\d+"})
     *
     * @param $userId
     * @return Response
     */
    public function filmAction(int $userId)
    {
        $this->manager->findUser($userId, $this->get('security.token_storage')->getToken()->getUser());
        return $this->redirect($this->generateUrl('homepage'));
    }

    /**
     * @Route("/deleteFriend/{userId}", name="delete_friend", requirements={"userId" = "\d+"})
     *
     * @param int $userId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteFrientAction(int $userId)
    {
        $this->manager->deleteFriend($userId, $this->get('security.token_storage')->getToken()->getUser());
        return $this->redirect($this->generateUrl('homepage'));
    }

    /**
     * @Route("/edit", name="edit_page")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function editAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $form = $this->createForm(ExtraterrestreType::class, $user);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $this->manager->editUser();
            return $this->redirect($this->generateUrl('homepage'));
        }
        return $this->render('default/edit.html.twig', [ 'form' => $form->createView()  ]);
    }
}
