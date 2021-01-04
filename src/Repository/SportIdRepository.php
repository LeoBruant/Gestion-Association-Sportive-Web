<?php

namespace App\Repository;

use App\Entity\SportId;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SportId|null find($id, $lockMode = null, $lockVersion = null)
 * @method SportId|null findOneBy(array $criteria, array $orderBy = null)
 * @method SportId[]    findAll()
 * @method SportId[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SportIdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SportId::class);
    }

    // /**
    //  * @return SportId[] Returns an array of SportId objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SportId
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
