<?php
namespace Entities;

/**
 * @Entity(repositoryClass="Repositories\PerfilesRepository")
 * @Table(name="app_perfilesadministrativos")
 */
class PerfilAdministrativo
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer",name="apa_id")
     * @var int
     **/
    protected $id;

    /**
     * @Column(type="string",name="apa_nombre",length=50)
     * @var string
     **/
    protected $nombre;

    /**
     * @Column(type="text",nullable=TRUE, name="apa_permisos")
     * @var string
     **/
    protected $permisos;

    /**
     * @Column(type="datetime",name="apa_creacion")
     **/
    protected $creacion;

    /**
     * @Column(type="datetime",name="apa_modificacion")
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
     * @return PerfilAdministrativo
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
        return utf8_encode($this->nombre);
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return PerfilAdministrativo
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return PerfilAdministrativo
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set modificacion
     *
     * @param \DateTime $modificacion
     *
     * @return PerfilAdministrativo
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

    /**
     * Set permisos
     *
     * @param string $permisos
     *
     * @return PerfilAdministrativo
     */
    public function setPermisos($permisos)
    {
        $this->permisos = $permisos;

        return $this;
    }

    /**
     * Get permisos
     *
     * @return string
     */
    public function getPermisos()
    {
        return $this->permisos;
    }

    /**
     * Set creacion
     *
     * @param \DateTime $creacion
     *
     * @return PerfilAdministrativo
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
}
