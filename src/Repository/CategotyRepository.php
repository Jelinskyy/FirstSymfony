<?php

namespace App\Repository;

use App\Entity\Categoty;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Categoty|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categoty|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categoty[]    findAll()
 * @method Categoty[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategotyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categoty::class);
    }

    // /**
    //  * @return Categoty[] Returns an array of Categoty objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Categoty
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
