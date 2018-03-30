<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }
    
    public function findRandomProducts()
    {
        return $this->createQueryBuilder('p')
        ->where('p.id = :id')
        ->setParameter('id', 33)
        ->getQuery()
        ->getResult();
    }
    
    public function loadProductsByCategory($category1, $category2)
    {
        return $this->createQueryBuilder('u')
        ->where('u.category = :category1 OR u.category = :category2')
        ->setParameter('category1', $category1)
        ->setParameter('category2', $category2)
        ->getQuery()
        ->getResult();
    }
    
    public function loadProductsByGenre($genre)
    {
        return $this->createQueryBuilder('u')
        ->where('u.genre = :genre OR u.genre = :mixte')
        ->setParameter('genre', $genre)
        ->setParameter('mixte', 'mixte')
        ->getQuery()
        ->getResult();
    }
    
    public function loadClothingByGenre($genre)
    {
        return $this->createQueryBuilder('u')
        ->where('u.category = :category1 AND (u.genre = :genre OR u.genre = :mixte)')
        ->setParameter('category1', 'Clothing')
        ->setParameter('genre', $genre)
        ->setParameter('mixte', 'mixte')
        ->getQuery()
        ->getResult();
    }
    
    public function loadProductAndImageById($id)
    {
        return $this->createQueryBuilder('p')
        ->join('p.image', 'i')
        ->addSelect('i')
        ->where('p.id = :id')
        ->setParameter('id', $id)
        ->getQuery()
        ->getArrayResult();
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('p')
            ->where('p.something = :value')->setParameter('value', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
