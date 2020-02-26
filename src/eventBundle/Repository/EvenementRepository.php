<?php

namespace eventBundle\Repository;
use Doctrine\ORM\EntityRepository;
use eventBundle\Entity\Evenement;
use eventBundle\Entity\Region;
use eventBundle\Entity\User;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\Query;


/**
 * EvenementRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EvenementRepository extends \Doctrine\ORM\EntityRepository
{

    public function findEntitiesByString($str){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p
                FROM eventBundle:Evenement p
                WHERE p.nomevent LIKE :str'
            )
            ->setParameter('str', '%'.$str.'%')
            ->getResult();
    }
    public function filtreregion($str){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p
                FROM eventBundle:Evenement p
                WHERE p.region =  ( select r.id FROM eventBundle:Region r WHERE r.nom LIKE :str) '

            )
            ->setParameter('str', '%'.$str.'%')
            ->getResult();
    }
    public function tableauuser(){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p.username , e.id
                FROM eventBundle:User p inner join eventBundle:Evenement e
        
                WHERE p.event =   e.id  '

            )

            ->getResult();
    }
    public function eventset(User $user){

        return $this->getEntityManager()

            ->createQuery(
                'UPDATE eventBundle:User p SET p.event = 10 WHERE p.id like :user'


            )->setParameter('user', $user->getId())

            ->getResult();
    }




}
