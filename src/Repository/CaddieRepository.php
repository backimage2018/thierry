<?php

namespace App\Repository;

use App\Entity\Caddie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class CaddieRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Caddie::class);
    }
    
    
    public function loadCaddieByUser($user)
    {
        return $this->createQueryBuilder('c')
        ->where('c.user = :user')
        ->setParameter('user', $user)
        ->getQuery()
        ->getArrayResult();
        
    }
    
    public function loadProductByUserInCaddie($id_user)
    {
        return $this->createQueryBuilder('p')
        ->innerJoin('p.product', 'cad')
        ->addSelect('cad')
        ->where('p.id = :pid')
        ->setParameter(':pid', $id_user)
        ->getQuery()
        ->getArrayResult();
        
    }
    
    public function loadProductInCaddie($id_user)
    {
        return $this->createQueryBuilder('c')
        ->innerJoin('c.product', 'p')
        ->addSelect('p')
        ->join('p.image', 'i')
        ->addSelect('i')
        ->where('c.user = :user')
        ->setParameter('user', $id_user)
        ->getQuery()
        ->getArrayResult();
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('c')
            ->where('c.something = :value')->setParameter('value', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
