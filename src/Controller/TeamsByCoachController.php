<?php


namespace App\Controller;


use App\Entity\Coach;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;

class TeamsByCoachController
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;
    /**
     * @var TeamRepository
     */
    private $teamRepository;

    public function __construct(EntityManagerInterface $manager, TeamRepository $teamRepository)
    {
        $this->manager = $manager;
        $this->teamRepository = $teamRepository;
    }

    public function __invoke(Coach $data)
    {
        return $this->teamRepository->findAllTeamsByCoachId($data->getId());
    }
}