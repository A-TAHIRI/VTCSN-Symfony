<?php

namespace App\Repository;

use App\Entity\Ride;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ride>
 *
 * @method Ride|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ride|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ride[]    findAll()
 * @method Ride[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RideRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ride::class);
    }

    public function save(Ride $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Ride $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function findTrajetsByUser(User $user): array
    {
        $query = $this->createQueryBuilder('t')
            ->innerJoin('t.user', 'u')
            ->andWhere('u = :user')
            ->setParameter('user', $user)
            ->getQuery();
    
        return $query->getResult();
    }
//    /**
//     * @return Ride[] Returns an array of Ride objects
//     */
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

//    public function findOneBySomeField($value): ?Ride
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

// public function findAllAsArray(User $user)
// {
//     $rideRepository = $this->getDoctrine()->getRepository(Ride::class);
//     $rides = $rideRepository->findBy(['user' => $user]);

//     $ridesArray = [];

//     foreach ($rides as $ride) {
//         $commandeArray = [
//             'id' => $ride->getId(),
//             'date' => $ride->getDate()->format('Y-m-d H:i'),
//             'rendezVous' => $ride->getRendezVous(),
//             'destination'=>$ride->getDestination(),
//             // Ajoutez d'autres champs de commande ici si nécessaire
//         ];

//         $ridesArray[] = $ridesArray;
//     }

//     return $ridesArray;
// }

}