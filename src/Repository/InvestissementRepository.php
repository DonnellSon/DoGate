<?php

namespace App\Repository;

use App\Entity\Investissement;
use App\Entity\Company;
use App\Entity\CompanyType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @extends ServiceEntityRepository<Investissement>
 *
 * @method Investissement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Investissement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Investissement[]    findAll()
 * @method Investissement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InvestissementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Investissement::class);
    }


    // public function findByCompanyType(string $type)
    // {
    //     return $this->createQueryBuilder('i')
    //         ->join('i.author', 'a')
    //         ->join('a.companies', 'c')
    //         ->join('c.companyType', 'ct')
    //         ->where('ct.type = :type')
    //         ->setParameter('type', $type)
    //         ->getQuery()
    //         ->getResult();
    // }
    


//    /**
//     * @return Investissement[] Returns an array of Investissement objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Investissement
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
