<?php

namespace App\Repository;

use App\Entity\Player;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Player|null find($id, $lockMode = null, $lockVersion = null)
 * @method Player|null findOneBy(array $criteria, array $orderBy = null)
 * @method Player[]    findAll()
 * @method Player[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Player::class);
    }

    public function findPlayersWithoutTeam($idClub)
    {
            $conn = $this->getEntityManager()->getConnection();

            $sql = '
                SELECT *
                FROM player
                INNER JOIN user ON user.id = player.user_id
                WHERE user.club_id = :club_id AND player.team_id IS NULL
            ';
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                'club_id' => $idClub
            ]);
            return $stmt->fetchAll();
    }

    public function excludeToTactics($playerId, $teamId){
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
                UPDATE tactic
                SET pos1_id = NULL 
                WHERE team_id = :id_team AND pos1_id = :id_player
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'id_team' => $teamId,
            'id_player' => $playerId
        ]);

        /*$sql = '
                UPDATE tactic
                SET pos2_id = NULL 
                WHERE team_id = :id_team AND pos2_id = :id_player
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'id_team' => $teamId,
            'id_player' => $playerId
        ]);

        $sql = '
                UPDATE tactic
                SET pos3_id = NULL 
                WHERE team_id = :id_team AND pos3_id = :id_player
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'id_team' => $teamId,
            'id_player' => $playerId
        ]);

        $sql = '
                UPDATE tactic
                SET pos4_id = NULL 
                WHERE team_id = :id_team AND pos4_id = :id_player
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'id_team' => $teamId,
            'id_player' => $playerId
        ]);

        $sql = '
                UPDATE tactic
                SET pos5_id = NULL 
                WHERE team_id = :id_team AND pos5_id = :id_player
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'id_team' => $teamId,
            'id_player' => $playerId
        ]);

        $sql = '
                UPDATE tactic
                SET pos6_id = NULL 
                WHERE team_id = :id_team AND pos6_id = :id_player
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'id_team' => $teamId,
            'id_player' => $playerId
        ]);

        $sql = '
                UPDATE tactic
                SET pos7_id = NULL 
                WHERE team_id = :id_team AND pos7_id = :id_player
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'id_team' => $teamId,
            'id_player' => $playerId
        ]);

        $sql = '
                UPDATE tactic
                SET pos8_id = NULL 
                WHERE team_id = :id_team AND pos8_id = :id_player
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'id_team' => $teamId,
            'id_player' => $playerId
        ]);

        $sql = '
                UPDATE tactic
                SET pos9_id = NULL 
                WHERE team_id = :id_team AND pos9_id = :id_player
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'id_team' => $teamId,
            'id_player' => $playerId
        ]);

        $sql = '
                UPDATE tactic
                SET pos10_id = NULL 
                WHERE team_id = :id_team AND pos10_id = :id_player
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'id_team' => $teamId,
            'id_player' => $playerId
        ]);

        $sql = '
                UPDATE tactic
                SET pos11_id = NULL 
                WHERE team_id = :id_team AND pos11_id = :id_player
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'id_team' => $teamId,
            'id_player' => $playerId
        ]);*/
    }


    // /**
    //  * @return Player[] Returns an array of Player objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Player
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
