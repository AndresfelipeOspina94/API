<?php
namespace Entities;

/**
 * @Entity(repositoryClass="Repositories\EstadossesionRepository")
 * @Table(name="itv_estadossesion")
 */
class Estadossesion
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer",name="itves_id")
     * @var int
     **/
    protected $id;

    /**
     * @Column(type="string",name="itves_nombre",length=50)
     * @var string
     **/
    protected $nombre;


    /**
     * @Column(type="datetime",name="itves_creacion")
     **/
    protected $creacion;

    /**
     * @Column(type="datetime",name="itves_modificacion")
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
     * @return Estadossesion
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
     * @return Estadossesion
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
     * @return Estadossesion
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
