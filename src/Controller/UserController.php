<?php


namespace App\Controller;


use App\Repository\ClubRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var ClubRepository
     */
    private $clubRepository;
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     * @param ClubRepository $clubRepository
     * @param EntityManagerInterface $manager
     */
    public function __construct(UserRepository $userRepository, ClubRepository $clubRepository, EntityManagerInterface $manager)
    {

        $this->userRepository = $userRepository;
        $this->clubRepository = $clubRepository;
        $this->manager = $manager;
    }

    /**
     * @Route("api/user/{userId}/club/{clubId}", methods={"PUT"})
     * @param $userId
     * @param $clubId
     * @return JsonResponse
     */
    public function setClubForUserAdmin($userId, $clubId){
        $user = $this->userRepository->find($userId);
        $club = $this->clubRepository->find($clubId);

        $user->setClub($club);
        $this->manager->persist($user);
        $this->manager->flush();

        return $this->json(['message' => 'modification de l\'utilisateur confirmé'], 200);
    }
}