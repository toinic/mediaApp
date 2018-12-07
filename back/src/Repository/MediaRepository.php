<?php

namespace App\Repository;

use App\Entity\Media;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Media|null find($id, $lockMode = null, $lockVersion = null)
 * @method Media|null findOneBy(array $criteria, array $orderBy = null)
 * @method Media[]    findAll()
 * @method Media[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MediaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Media::class);
    }

    public function findAllAssoc(){
      $em=$this->getEntityManager();
      $dql='SELECT m.id, m.type, m.title, m.author, m.cover FROM App\Entity\Media m ORDER BY m.title ASC';
      $query=$em->createQuery($dql);
      return $query->execute();
    }

    public function findByFiltersAssoc($type, $search)
    {
      $connection=$this->getEntityManager()->getConnection();
      $sql=
        ' SELECT m.id, m.type, m.title, m.author, m.cover
          FROM media m
          -- JOIN question q on q.id=a.question_id
          WHERE 1=1
        ';

      $params=[];
      if($type){
        $sql .= ' AND m.type=:type';
        $params[':type']=$type;
      }
      if($search){
        $sql .= ' AND m.author LIKE :search';
        $params[':search']='%'.$search.'%';
      }

      $query=$connection->prepare($sql);
      $query->execute($params);
      $medias=$query->fetchAll();

      return $medias;
    }
}
