<?php

namespace App\Repository;

use App\Entity\Content;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Content|null find($id, $lockMode = null, $lockVersion = null)
 * @method Content|null findOneBy(array $criteria, array $orderBy = null)
 * @method Content[]    findAll()
 * @method Content[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Content::class);
    }

    public function findChildren($idParent){
        $qb = $this->createQueryBuilder('c')
            ->where('c.parent = :id')->setParameter('id', $idParent)->getQuery();
        return $qb->execute();
    }

    public function findAllWithUsers(){
        $qb = $this->createQueryBuilder('c')
            ->innerJoin('c.author', 'u')
            ->addSelect('u');
        return $qb->getQuery()
            ->getResult();
    }
}
