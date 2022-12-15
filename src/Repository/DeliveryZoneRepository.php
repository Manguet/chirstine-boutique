<?php

namespace App\Repository;

use App\Entity\DeliveryZone;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DeliveryZone>
 *
 * @method DeliveryZone|null find($id, $lockMode = null, $lockVersion = null)
 * @method DeliveryZone|null findOneBy(array $criteria, array $orderBy = null)
 * @method DeliveryZone[]    findAll()
 * @method DeliveryZone[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeliveryZoneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DeliveryZone::class);
    }

    public function save(DeliveryZone $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(DeliveryZone $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
