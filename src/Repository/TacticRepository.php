<?php

namespace App\Repository;

use App\Entity\Tactic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tactic|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tactic|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tactic[]    findAll()
 * @method Tactic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TacticRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tactic::class);
    }

    public function excludePlayerOfTactics($playerId){
        $cnx = $this->getEntityManager()->getConnection();

        $sql = '
            UPDATE tactic
            SET pos1_id = null
            WHERE pos1_id = :id_player
        ';
        $stmt = $cnx->prepare($sql);
        $stmt->execute([
            'id_player' => $playerId
        ]);

        $sql = '
            UPDATE tactic
            SET pos2_id = null
            WHERE pos2_id = :id_player
        ';
        $stmt = $cnx->prepare($sql);
        $stmt->execute([
            'id_player' => $playerId
        ]);

        $sql = '
            UPDATE tactic
            SET pos3_id = null
            WHERE pos3_id = :id_player
        ';
        $stmt = $cnx->prepare($sql);
        $stmt->execute([
            'id_player' => $playerId
        ]);

        $sql = '
            UPDATE tactic
            SET pos4_id = null
            WHERE pos4_id = :id_player
        ';
        $stmt = $cnx->prepare($sql);
        $stmt->execute([
            'id_player' => $playerId
        ]);

        $sql = '
            UPDATE tactic
            SET pos5_id = null
            WHERE pos5_id = :id_player
        ';
        $stmt = $cnx->prepare($sql);
        $stmt->execute([
            'id_player' => $playerId
        ]);

        $sql = '
            UPDATE tactic
            SET pos6_id = null
            WHERE pos6_id = :id_player
        ';
        $stmt = $cnx->prepare($sql);
        $stmt->execute([
            'id_player' => $playerId
        ]);

        $sql = '
            UPDATE tactic
            SET pos7_id = null
            WHERE pos7_id = :id_player
        ';
        $stmt = $cnx->prepare($sql);
        $stmt->execute([
            'id_player' => $playerId
        ]);

        $sql = '
            UPDATE tactic
            SET pos8_id = null
            WHERE pos8_id = :id_player
        ';
        $stmt = $cnx->prepare($sql);
        $stmt->execute([
            'id_player' => $playerId
        ]);

        $sql = '
            UPDATE tactic
            SET pos9_id = null
            WHERE pos9_id = :id_player
        ';
        $stmt = $cnx->prepare($sql);
        $stmt->execute([
            'id_player' => $playerId
        ]);

        $sql = '
            UPDATE tactic
            SET pos10_id = null
            WHERE pos10_id = :id_player
        ';
        $stmt = $cnx->prepare($sql);
        $stmt->execute([
            'id_player' => $playerId
        ]);

        $sql = '
            UPDATE tactic
            SET pos11_id = null
            WHERE pos11_id = :id_player
        ';
        $stmt = $cnx->prepare($sql);
        $stmt->execute([
            'id_player' => $playerId
        ]);
    }

    // /**
    //  * @return Tactic[] Returns an array of Tactic objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tactic
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
