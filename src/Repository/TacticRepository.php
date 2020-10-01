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
