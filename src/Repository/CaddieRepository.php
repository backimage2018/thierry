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
