<?php
namespace App\Controller;

use App\Entity\Club;
use App\Repository\PlayerRepository;
use Doctrine\ORM\EntityManagerInterface;

class PlayersWithoutTeamController {
    /**
     * @var EntityManagerInterface
     */
    private $manager;
    /**
     * @var PlayerRepository
     */
    private $playerRepository;


    /**
     * PlayersWithoutTeamController constructor.
     * @param EntityManagerInterface $manager
     * @param PlayerRepository $playerRepository
     */
    public function __construct(EntityManagerInterface $manager, PlayerRepository $playerRepository)
    {

        $this->manager = $manager;
        $this->playerRepository = $playerRepository;
    }


    public function __invoke(Club $data)
    {
        dd($data);
       return $this->playerRepository->findPlayersWithoutTeam($data->getId());
    }



}