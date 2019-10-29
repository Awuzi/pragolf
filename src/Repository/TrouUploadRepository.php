<?php

namespace App\Repository;

use App\Entity\TrouUpload;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TrouUpload|null find($id, $lockMode = null, $lockVersion = null)
 * @method TrouUpload|null findOneBy(array $criteria, array $orderBy = null)
 * @method TrouUpload[]    findAll()
 * @method TrouUpload[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrouUploadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TrouUpload::class);
    }

    // /**
    //  * @return TrouUpload[] Returns an array of TrouUpload objects
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
    public function findOneBySomeField($value): ?TrouUpload
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
