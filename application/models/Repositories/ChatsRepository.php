<?php
namespace Repositories;

use Doctrine\ORM\EntityRepository;

/**
 * Class ChatsRepository
 * @package Repositories
 */
class ChatsRepository extends EntityRepository
{
    /**
     * @var string
     */
    private $entity = "Entities\\Chats";
    //Entities relation
    private $paciente = "Entities\\Pacientes";
    private $empleado= "Entities\\Empleado";
    private $sesion= "Entities\\Sesiones";
    private $estadossesion = "Entities\\Estadossesion";


    public function traerTodosOrdenadoPorIdAgrupados($cantidad,$offset,$orientacion)
    {
      $qb = $this->_em->createQueryBuilder();
      $qb
      ->select('MAX(ch.id) as id,ch.sesion,ch.paciente, ch.admin, ch.mensaje, MIN(ch.visto) as visto,MAX(ch.modificacion) as ultima_modificacion, ch.creacion,ch.modificacion')
      ->addSelect("CONCAT(p.nombres,' ',p.apellidos) as nombre_paciente")
      ->addSelect('e.nombre as estado')
      ->addSelect('s.codigo, s.creacion as fecha_sesion')
      ->from($this->entity, 'ch')
      ->innerJoin($this->paciente, 'p', 'WITH', $qb->expr()->eq('ch.paciente', 'p.id'))
      ->innerJoin($this->sesion, 's', 'WITH', $qb->expr()->eq('ch.sesion', 's.id'))
      ->innerJoin($this->estadossesion, 'e', 'WITH', $qb->expr()->eq('s.estadoactual', 'e.id'))
      ->where('ch.admin = 0')
      ->groupBy('ch.sesion')
      ->orderBy('visto, ultima_modificacion', (($orientacion==TRUE)?'DESC':'ASC'))
      ->setFirstResult($offset)
      ->setMaxResults($cantidad);
      $q = $qb->getQuery();
      $results = $q->getArrayResult();
      return $results;
    }

    //Agregar Chats
    public function agregar($datos)
    {
      //creamos una instancia de la entidad Chats
      //-------------------
      $chat = new $this->entity;
      //establecemos las propiedades a través de los setters
      if(!empty($datos->id_sesion)){
        $chat->setSesion($datos->id_sesion);
      }
      if(!empty($datos->id_paciente)){
        $chat->setPaciente($datos->id_paciente);
      }
      if(!empty($datos->mensaje)){
        $chat->setMensaje($datos->mensaje);
      }else{
        $chat->setMensaje("");
      }
      if(!empty($datos->foto)){
        $chat->setFoto($datos->foto);
      }else{
        $chat->setFoto("");
      }
      $chat->setVisto(intval($datos->visto));
      //-----------
      $chat->setAdmin(intval($datos->id_admin));


      // if(!empty($fecha)){
      //   $chat->setFecha($fecha);
      // }

      //guardamos la entidad en la tabla Chats
      $this->_em->persist($chat);
      $this->_em->flush();
    }

    //Actualizar Chats Admin - Marca como visto solo los mensajes de los usuarios
    public function actualizar($id,$datos)
    {
      //------------------
      $fechaModificacion = new \DateTime("now");
      //-----------------
      $qb = $this->_em->createQueryBuilder();
      $qb->update($this->entity, 'ch');

      if(!empty($datos->visto)){
        $qb->set('ch.visto', '?1')
        ->setParameter(1, $datos->visto);
      }
      //-----------------------
      // $qb->set('ch.modificacion', '?2')
      // ->setParameter(2, $fechaModificacion);
      //-----------------------
      $qb->where('ch.sesion = ?2')
        ->setParameter(2, $datos->id_sesion);
      $qb->andwhere('ch.admin = ?3')
       ->setParameter(3, 0);
      $q=$qb->getQuery();
      $p = $q->execute();
    }
    //Actualizar Chats Admin - Marca como visto solo los mensajes de los administradores
    public function actualizar2($datos)
    {
      //------------------
      $fechaModificacion = new \DateTime("now");
      //-----------------
      $qb = $this->_em->createQueryBuilder();
      $qb->update($this->entity, 'ch');

      if(!empty($datos->visto)){
        $qb->set('ch.visto', '?1')
        ->setParameter(1, $datos->visto);
      }
      //-----------------------
      // $qb->set('ch.modificacion', '?2')
      // ->setParameter(2, $fechaModificacion);
      //-----------------------
      $qb->where('ch.sesion = ?2')
        ->setParameter(2, $datos->id_sesion);
      $qb->andwhere('ch.admin != ?3')
       ->setParameter(3, 0);
      $q=$qb->getQuery();
      $p = $q->execute();
    }

    //Listado id chat paciente
    public function traerChatsPorIdPaciente($paciente,$sesion)
    {
      $qb = $this->_em->createQueryBuilder();
      $qb
      ->select('ch.id,ch.sesion,ch.paciente, ch.admin, ch.mensaje, ch.foto, ch.visto, ch.creacion,ch.modificacion')
      ->addSelect('p.nombres as Paciente, p.apellidos')
      ->from($this->entity, 'ch')
      ->innerJoin($this->paciente, 'p', 'WITH', $qb->expr()->eq('ch.paciente', 'p.id'))
      ->where("ch.paciente=?1 and ch.sesion=?2")
      ->setParameter(1, $paciente)
      ->setParameter(2, $sesion)
      ->orderBy('ch.id','ASC');
      $q = $qb->getQuery();
      $results = $q->getArrayResult();
      return $results;
    }

    //Listado id chat admin
    public function traerChatsPorIdAdmin($sesion)
    {
      $qb = $this->_em->createQueryBuilder();
      $qb
      ->select('ch.id,ch.sesion,ch.paciente, ch.admin, ch.mensaje, ch.foto, ch.visto, ch.creacion,ch.modificacion')
      //->addSelect('e.nombres as Empleado, e.apellidos')
      ->from($this->entity, 'ch')
      //->innerJoin($this->empleado, 'e', 'WITH', $qb->expr()->eq('ch.admin', 'e.id'))
      ->where("ch.sesion=?1")
      ->setParameter(1, $sesion)
      ->orderBy('ch.id','ASC');
      $q = $qb->getQuery();
      $results = $q->getArrayResult();
      return $results;
    }


}
