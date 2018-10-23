<?php
namespace App\Repository;

use App\Entity\Depense;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class DepenseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Depense::class);
    }


    /**
     * 
     * @return Depense[]
     */
    public function findAllOrderByDateBuy(): array
    {
        // automatically knows to select Products
        // the "p" is an alias you'll use in the rest of the query
        $qb = $this->createQueryBuilder('p')
            ->orderBy('p.dateBuy', 'ASC')
            ->getQuery();

        return $qb->execute();

        // to get just one result:
        // $product = $qb->setMaxResults(1)->getOneOrNullResult();
    }

}