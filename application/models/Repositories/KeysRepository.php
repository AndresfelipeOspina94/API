<?php
namespace Repositories;

use Doctrine\ORM\EntityRepository;

/**
 * Class KeysRepository
 * @package Repositories
 */
class KeysRepository extends EntityRepository
{
    /**
     * @var string
     */
    private $entity = "Entities\\Keys";
    public function agregar($token)
    {
      $keytoadd = new $this->entity;    
      
      $keytoadd->setToken($token);
      // $keytoadd->setIgnorelimits(0);
      // var_dump($keytoadd);
      $this->_em->persist($keytoadd);
      $this->_em->flush();
    }
}
