<?php

namespace App\Repository;

use App\Entity\CartHasClothes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CartHasClothes>
 *
 * @method CartHasClothes|null find($id, $lockMode = null, $lockVersion = null)
 * @method CartHasClothes|null findOneBy(array $criteria, array $orderBy = null)
 * @method CartHasClothes[]    findAll()
 * @method CartHasClothes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartHasClothesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CartHasClothes::class);
    }

    public function save(CartHasClothes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CartHasClothes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
