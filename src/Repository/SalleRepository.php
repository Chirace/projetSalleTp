<?php

namespace App\Repository;

use App\Entity\Salle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Salle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Salle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Salle[]    findAll()
 * @method Salle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SalleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Salle::class);
    }

    public function findByBatimentAndEtageMax($batiment, $etage) {
        $queryBuilder = $this->createQueryBuilder('s');
        $queryBuilder->where('s.batiment = :batiment')
        ->setParameter('batiment', $batiment)
        ->andWhere('s.etage <= :etage')
        ->setParameter('etage', $etage)
        ->orderBy('s.etage', 'asc');
        return $queryBuilder->getQuery()->getResult();
    }

    public function findSalleBatAouB() {
        $query = $this->getEntityManager()
        ->createQuery("SELECT s FROM App\Entity\Salle s
        WHERE s.batiment IN ('A', 'B')");
        return $query->getResult();
    }

    public function plusUnEtage() {
        $query = $this->getEntityManager()
        ->createQuery("UPDATE App\Entity\Salle s
        SET s.numero = s.numero + '1'");
        $result = $query->execute();
    }
       
       
       

    // /**
    //  * @return Salle[] Returns an array of Salle objects
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
    public function findOneBySomeField($value): ?Salle
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
