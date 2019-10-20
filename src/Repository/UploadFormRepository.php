<?php

namespace App\Repository;

use App\Entity\UploadForm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UploadForm|null find($id, $lockMode = null, $lockVersion = null)
 * @method UploadForm|null findOneBy(array $criteria, array $orderBy = null)
 * @method UploadForm[]    findAll()
 * @method UploadForm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UploadFormRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UploadForm::class);
    }

    // /**
    //  * @return UploadForm[] Returns an array of UploadForm objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UploadForm
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
