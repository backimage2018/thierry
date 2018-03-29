<?php

namespace App\Repository;

use App\Entity\Stock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class StockRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Stock::class);
    }
    
    public function loadProductsInAlert()
    {
        return $this->createQueryBuilder('s')
        ->join('s.product', 'p')
        ->addSelect('p')
        ->where('s.eshopquantity < :quantity OR s.storequantity < :quantity')
        ->setParameter('quantity', 4)
        ->getQuery()
        ->getArrayResult();
    }
    
    public function loadProductsEshop()
    {
        return $this->createQueryBuilder('s')
        ->join('s.product', 'p')
        ->addSelect('p')
        ->where('s.eshopquantity > :quantity')
        ->setParameter('quantity', 0)
        ->getQuery()
        ->getArrayResult();
    }
    
    public function loadProductsStore()
    {
        return $this->createQueryBuilder('s')
        ->join('s.product', 'p')
        ->addSelect('p')
        ->where('s.storequantity > :quantity')
        ->setParameter('quantity', 0)
        ->getQuery()
        ->getArrayResult();
    }
    

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('s')
            ->where('s.something = :value')->setParameter('value', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
