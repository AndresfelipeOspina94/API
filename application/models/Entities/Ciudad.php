<?php
namespace Entities;

/**
 * @Entity(repositoryClass="Repositories\CiudadRepository")
 * @Table(name="app_ciudades")
 */
class Ciudad
{
  /**
   * @Id
   * @GeneratedValue
   * @Column(type="integer",name="ac_id")
   * @var int
   **/
  protected $id;

  /**
   * @Column(type="string",name="ac_nombre",length=50)
   * @var string
   **/
  protected $nombre;

  /**
     * @Column(type="integer",name="ac_departamento")
     * @OneToMany(targetEntity="Departamento")
     * @JoinColumn(name="ac_departamento", referencedColumnName="ad_id")
     * @var int
     **/
    protected $departamento;


  /**
   * @Column(type="datetime",name="ac_creacion")
   **/
  protected $creacion;

  /**
   * @Column(type="datetime",name="ac_modificacion")
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
     * @return Ciudad
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
     * Set departamento
     *
     * @param integer $departamento
     *
     * @return Ciudad
     */
    public function setDepartamento($departamento)
    {
        $this->departamento = $departamento;

        return $this;
    }

    /**
     * Get departamento
     *
     * @return integer
     */
    public function getDepartamento()
    {
        return $this->departamento;
    }

    /**
     * Set creacion
     *
     * @param \DateTime $creacion
     *
     * @return Ciudad
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
     * @return Ciudad
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
