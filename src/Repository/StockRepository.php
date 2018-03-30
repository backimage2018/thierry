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
    
    public function loadAllProducts()
    {
        return $this->createQueryBuilder('s')
        ->join('s.product', 'p')
        ->addSelect('p')
        ->getQuery()
        ->getArrayResult();
    }
    
    public function loadProductsInAlert()
    {
        return $this->createQueryBuilder('s')
        ->join('s.product', 'p')
        ->addSelect('p')
        ->join('p.image', 'i')
        ->addSelect('i')
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
        ->join('p.image', 'i')
        ->addSelect('i')
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
        ->join('p.image', 'i')
        ->addSelect('i')
        ->where('s.storequantity > :quantity')
        ->setParameter('quantity', 0)
        ->getQuery()
        ->getArrayResult();
    }
    
    public function loadRowStore($id_stock)
    {
        return $this->createQueryBuilder('s')
        ->join('s.product', 'p')
        ->addSelect('p')
        ->where('s.id = :id')
        ->setParameter('id', $id_stock)
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
