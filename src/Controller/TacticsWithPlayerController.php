<?php

namespace App\Controller;

use App\Entity\Player;
use App\Repository\TacticRepository;
use Doctrine\ORM\EntityManagerInterface;

class TacticsWithPlayerController
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;
    /**
     * @var TacticRepository
     */
    private $tacticRepository;

    /**
     * PlayerExcludeToTacticsController constructor.
     * @param EntityManagerInterface $manager
     * @param TacticRepository $tacticRepository
     */
    public function __construct(EntityManagerInterface $manager, TacticRepository $tacticRepository)
    {

        $this->manager = $manager;
        $this->tacticRepository = $tacticRepository;
    }

    public function __invoke(Player $data)
    {
        return $this->tacticRepository->findTacticsWithPlayer($data->getId(), $data->getTeam()->getId());
    }
}