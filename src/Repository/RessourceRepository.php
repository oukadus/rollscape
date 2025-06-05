<?php

namespace App\Repository;

use App\Entity\Tag;
use App\Entity\User;
use App\Entity\Ressource;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

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
        // public function findBySearchAndType(?string $search, ?string $typeSlug): array
        // {
        //     // on crée une variable $qb qui est une instance de QueryBuilder
        //     $qb= $this->createQueryBuilder('r')
        //         ->leftJoin('r.tags', 't')
        //         ->addSelect('t')
        //         ->leftJoin('r.type', 'ty')
        //         ->addSelect('ty');


        //     // si il y a une recherche, on effectue une recherche sur le titre, la description et le nom du tag
        //     if ($search) {
        //         $qb->andWhere('r.title LIKE :search OR r.description LIKE :search OR t.name LIKE :search')
        //         ->setParameter('search', '%' . $search . '%');
        //     }

        //     if ($typeSlug) {
        //         $qb->andWhere('ty.slug = :type')
        //         ->setParameter('type', $typeSlug);
        //     }

        //     $qb->distinct(); // évite les doublons si plusieurs tags correspondent

        //     return $qb->getQuery()->getResult();
        // }

        // Toutes les ressources
        public function createQueryForAll(): \Doctrine\ORM\Query
        {
            return $this->createQueryBuilder('r')
                ->leftJoin('r.tags', 't')->addSelect('t')
                ->leftJoin('r.type', 'ty')->addSelect('ty')
                ->orderBy('r.created_at', 'DESC')
                ->getQuery();
        }

        // Les ressources d’un utilisateur
        public function createQueryForUser(User $user): \Doctrine\ORM\Query
        {
            return $this->createQueryBuilder('r')
                ->leftJoin('r.tags', 't')->addSelect('t')
                ->leftJoin('r.type', 'ty')->addSelect('ty')
                ->andWhere('r.user = :user')
                ->setParameter('user', $user)
                ->orderBy('r.created_at', 'DESC')
                ->getQuery();
        }

        // Dernières ressources
        public function findLatestPublic(int $limit = 10): array
        {
            return $this->createQueryBuilder('r')
                ->orderBy('r.id', 'DESC')
                ->setMaxResults($limit)
                ->getQuery()
                ->getResult();
        }

        
        // La recherche avec type
       public function createQueryForSearch(?string $search, ?string $typeSlug): \Doctrine\ORM\Query
        {
            $qb = $this->createQueryBuilder('r')
                ->leftJoin('r.tags', 't')->addSelect('t')
                ->leftJoin('r.type', 'ty')->addSelect('ty');

            if ($search) {
                $keywords = array_filter(explode(' ', $search));

                foreach ($keywords as $index => $word) {
                    $qb->andWhere("
                        r.title LIKE :word$index
                        OR r.description LIKE :word$index
                        OR t.name LIKE :word$index
                    ")
                    ->setParameter("word$index", '%' . $word . '%');
                }
            }

            if ($typeSlug) {
                $qb->andWhere('ty.slug = :type')
                ->setParameter('type', $typeSlug);
            }

            return $qb->distinct() // évite doublons si plusieurs tags matchent
                    ->orderBy('r.created_at', 'DESC')
                    ->getQuery();
        }

        // Filtrer par tag
        public function getQueryBuilderByTag(Tag $tag): QueryBuilder
        {
            return $this->createQueryBuilder('r')
                ->leftJoin('r.tags', 't')
                ->addSelect('t')
                ->where('t = :tag')
                ->setParameter('tag', $tag)
                ->orderBy('r.created_at', 'DESC');
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
