<?php

namespace App\Repository;

use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Student|null find($id, $lockMode = null, $lockVersion = null)
 * @method Student|null findOneBy(array $criteria, array $orderBy = null)
 * @method Student[]    findAll()
 * @method Student[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Student::class);
    }

    // /**
    //  * @return Student[] Returns an array of Student objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Student
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function showAllStudentByNsc()
    {
        return $this->createQueryBuilder('s')
            ->where('s.nsc LIKE :nsc')
            ->andWhere('s.email LIKE :email')
            ->setParameter('nsc', '0%')
            ->setParameter('email', 'test@gmail.com')
            ->getQuery()
            ->getResult()
        ;
    }
    public function listStudentByClass($id) 
    {
        return $this->createQueryBuilder('s')
        ->join('s.classroom ','c')
            ->addSelect('c')
            ->where('c.id=:id')
            ->setParameter('id',$id)
            ->getQuery()
            ->getResult()
        ;
    }
    public function findStudentByEmail() 
    {
        $entityManager=$this->getEntityManager();
        $query =$entityManager->createQuery('select p FROM App\Entity\Student p ORDER BY p.email ASC ');
        return $query->getResult();
    }
    public function findStudentByEmail2() 
    {
        $entityManager=$this->getEntityManager();
        $query =$entityManager->createQuery('select p FROM App\Entity\Student p ORDER BY p.email DESC ');
        return $query->getResult();
    }
    public function findStudentByDate() 
    {
        $entityManager=$this->getEntityManager();
        $query =$entityManager->createQuery('select p FROM App\Entity\Student p   ORDER BY p.date DESC  ')
        ;
  
       
        
            return $query->getResult();
        
    }
    public function findStudentByEnabled() 
    {
        return $this->createQueryBuilder('s')
            ->where('s.enabled = 1')
          
            ->getQuery()
            ->getResult()
        ;
        
    }
    public function findStudentByDateC() 
    {
        $entityManager=$this->getEntityManager();
        $query =$entityManager->createQuery('select p FROM App\Entity\Student p where p.date >= :d1 and p.date <= :d2 ')
        ->setParameter('d1', '2000-11-02')
        ->setParameter('d2', '2002-11-02')
        ;
  
       
        
            return $query->getResult();
        
    }
    public function findMoyenneByClass($id) 
    {
        $entityManager=$this->getEntityManager();
        $query =$entityManager->createQuery('select sum(p.moyenne)/count(p) FROM App\Entity\Student p where p.classroom =:id ')
        ->setParameter('id', $id)
       
        ;
  
       
        
            return $query->getSingleScalarResult();
        
    }
    public function findRedoublantByClass($id) 
    {
        $entityManager=$this->getEntityManager();
        $query =$entityManager->createQuery('select count(p) FROM App\Entity\Student p where p.classroom =:id and p.moyenne <= 8')
        ->setParameter('id', $id)
       
        ;
  
       
        
            return $query->getSingleScalarResult();
        
    }
   

}
