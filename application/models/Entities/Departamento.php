<?php
namespace Entities;

/**
 * @Entity(repositoryClass="Repositories\DepartamentoRepository")
 * @Table(name="app_departamentos")
 */
class Departamento
{
  /**
   * @Id
   * @GeneratedValue
   * @Column(type="integer",name="ad_id")
   * @var int
   **/
  protected $id;

  /**
   * @Column(type="string",name="ad_nombre",length=50)
   * @var string
   **/
  protected $nombre;


  /**
   * @Column(type="datetime",name="ad_creacion")
   **/
  protected $creacion;

  /**
   * @Column(type="datetime",name="ad_modificacion")
   **/
  protected $modificacion;

  public function __construct()
  {
      $this->creacion = new \DateTime("now");
      $this->modificacion = new \DateTime("now");
  }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Departamento
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set creacion
     *
     * @param \DateTime $creacion
     *
     * @return Departamento
     */
    public function setCreacion($creacion)
    {
        $this->creacion = $creacion;

        return $this;
    }

    /**
     * Get creacion
     *
     * @return \DateTime
     */
    public function getCreacion()
    {
        return $this->creacion;
    }


    /**
     * Set modificacion
     *
     * @param \DateTime $modificacion
     *
     * @return Departamento
     */
    public function setModificacion($modificacion)
    {
        $this->modificacion = $modificacion;

        return $this;
    }

    /**
     * Get modificacion
     *
     * @return \DateTime
     */
    public function getModificacion()
    {
        return $this->modificacion;
    }


}
