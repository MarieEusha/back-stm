<?php

namespace App\Repository;

use App\Entity\TrainingMissed;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TrainingMissed|null find($id, $lockMode = null, $lockVersion = null)
 * @method TrainingMissed|null findOneBy(array $criteria, array $orderBy = null)
 * @method TrainingMissed[]    findAll()
 * @method TrainingMissed[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrainingMissedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TrainingMissed::class);
    }

    // /**
    //  * @return TrainingMissed[] Returns an array of TrainingMissed objects
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
    public function findOneBySomeField($value): ?TrainingMissed
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
