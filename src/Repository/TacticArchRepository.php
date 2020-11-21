<?php

namespace App\Repository;

use App\Entity\TacticArch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TacticArch|null find($id, $lockMode = null, $lockVersion = null)
 * @method TacticArch|null findOneBy(array $criteria, array $orderBy = null)
 * @method TacticArch[]    findAll()
 * @method TacticArch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TacticArchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TacticArch::class);
    }

    // /**
    //  * @return TacticArch[] Returns an array of TacticArch objects
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
    public function findOneBySomeField($value): ?TacticArch
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
