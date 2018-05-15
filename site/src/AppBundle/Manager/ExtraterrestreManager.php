<?php
/**
 * Created by PhpStorm.
 * User: nasri
 * Date: 14/05/2018
 * Time: 14:58
 */

namespace AppBundle\Manager;


use AppBundle\Entity\Extraterrestre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExtraterrestreManager
{
    private $em;
    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->repository = $entityManager->getRepository(Extraterrestre::class);
    }

    /**
     * @param Extraterrestre $extraterrestre
     * @return array
     */
    public function withoutCurrentUser(Extraterrestre $extraterrestre)
    {
        $users = $this->repository->allFriends($extraterrestre);
        $tab = array();
        foreach ($users as $user)
        {
            $tab[] = [ 'name' => $user->getusername(), 'id' => $user->getId()];
        }
        return $tab;
    }

    public function withoutCurrentFriends(Extraterrestre $extraterrestre)
    {
        $tab = array();
        foreach ($extraterrestre->getFriends() as $friends)
        {
            $tab[] = ['name' => $friends->getusername(), 'id' => $friends->getId()];
        }
        return $tab;
    }
    /**
     * @param int $id
     * @param Extraterrestre $currentUser
     * @throws \Exception
     * @internal param Extraterrestre $CurrentUser
     * @internal param Extraterrestre $user
     */
    public function findUser(int $id, Extraterrestre $currentUser)
    {
        $user = $this->repository->find($id);

        if (!count($currentUser->getFriends()) < 1)
        {
            foreach ($currentUser->getFriends() as $friend)
            {
                if($friend->getId() != $user->getId())
                {
                    $currentUser->addFriend($this->repository->find($id));
                    $this->em->flush();
                    return;
                }
                throw new \Exception('Something went wrong!');
            }
        }
        $currentUser->addFriend($this->repository->find($id));
        $this->em->flush();
        return;
    }

    /**
     * @param int $id
     * @param Extraterrestre $currentUser
     */
    public function deleteFriend(int $id, Extraterrestre $currentUser)
    {
        $user = $this->repository->find($id);
        $currentUser->removeFriend($user);
        $this->em->flush();
        return;
    }
}
