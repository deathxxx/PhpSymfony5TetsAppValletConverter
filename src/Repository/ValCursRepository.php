<?php

namespace App\Repository;

use App\Entity\ValCurs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ValCurs|null find($id, $lockMode = null, $lockVersion = null)
 * @method ValCurs|null findOneBy(array $criteria, array $orderBy = null)
 * @method ValCurs[]    findAll()
 * @method ValCurs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ValCursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ValCurs::class);
    }

    // /**
    //  * @return ValCurs[] Returns an array of ValCurs objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ValCurs
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function truncate():void {
        $connection = $this->getEntityManager()->getConnection();
        $platform = $connection->getDatabasePlatform();
        $connection->executeUpdate($platform->getTruncateTableSQL('val_curs',false));
    }
}
