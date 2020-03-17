<?php

namespace App\Repository;

use App\Entity\Logiciel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Logiciel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Logiciel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Logiciel[]    findAll()
 * @method Logiciel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LogicielRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Logiciel::class);
    }

    public function findByOrdinateur($ip) {
        return $this->createQueryBuilder('l')
        ->join('l.machine_installees', 'o', 'WITH', 'o.ip = :ip')
        ->setParameter('ip', $ip)
        ->getQuery()
        ->getResult();
    }

    public function getLogicielsEtEventuellementOrdinateurs() {
        return $this->createQueryBuilder('l')
        ->select('l.nom', 'o.ip')
        ->leftjoin('l.machine_installees', 'o')
        ->getQuery()
        ->getResult();
    }
       

    // /**
    //  * @return Logiciel[] Returns an array of Logiciel objects
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
    public function findOneBySomeField($value): ?Logiciel
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
