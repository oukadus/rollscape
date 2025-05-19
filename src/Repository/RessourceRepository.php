<?php

namespace App\Repository;

use App\Entity\Ressource;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ressource>
 */
class RessourceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ressource::class);
    }

    //    /**
    //     * @return Ressource[] Returns an array of Ressource objects
    //     */
        public function findBySearchAndType(?string $search, ?string $typeSlug): array
        {
            // on crée une variable $qb qui est une instance de QueryBuilder
            $qb= $this->createQueryBuilder('r')
                ->leftJoin('r.tags', 't')
                ->addSelect('t')
                ->leftJoin('r.type', 'ty')
                ->addSelect('ty');


            // si il y a une recherche, on effectue une recherche sur le titre, la description et le nom du tag
            if ($search) {
                $qb->andWhere('r.title LIKE :search OR r.description LIKE :search OR t.name LIKE :search')
                ->setParameter('search', '%' . $search . '%');
            }

            if ($typeSlug) {
                $qb->andWhere('ty.slug = :type')
                ->setParameter('type', $typeSlug);
            }

            $qb->distinct(); // évite les doublons si plusieurs tags correspondent

            return $qb->getQuery()->getResult();
        }

       //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Ressource
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
