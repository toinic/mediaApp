<?php

namespace App\Repository;

use App\Entity\Loaning;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Loaning|null find($id, $lockMode = null, $lockVersion = null)
 * @method Loaning|null findOneBy(array $criteria, array $orderBy = null)
 * @method Loaning[]    findAll()
 * @method Loaning[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LoaningRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Loaning::class);
    }

    // /**
    //  * @return Loaning[] Returns an array of Loaning objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Loaning
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
