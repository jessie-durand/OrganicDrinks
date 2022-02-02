<?php

namespace App\Repository;

use App\Entity\CategoryDrink;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategoryDrink|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryDrink|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryDrink[]    findAll()
 * @method CategoryDrink[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryDrinkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryDrink::class);
    }

    // /**
    //  * @return CategoryDrink[] Returns an array of CategoryDrink objects
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
    public function findOneBySomeField($value): ?CategoryDrink
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
