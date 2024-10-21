<?php
namespace Entities;

/**
 * @Entity(repositoryClass="Repositories\TipoDocumentoRepository")
 * @Table(name="app_tiposdocumentos")
 */
class TipoDocumento
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer",name="atd_id", length=1)
     * @var int
     **/
    protected $id;

    /**
     * @Column(type="string",name="atd_nomenclatura")
     * @var int
     **/
    protected $nomenclatura;

    /**
     * @Column(type="string",name="atd_descripcion")
     **/
    protected $descripcion;

    /**
     * @Column(type="datetime",name="atd_creacion")
     **/
    protected $creacion;

    /**
     * @Column(type="datetime",name="atd_modificacion")
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
     * Set nomenclatura
     *
     * @param string $nomenclatura
     *
     * @return TipoDocumento
     */
    public function setNomenclatura($nomenclatura)
    {
        $this->nomenclatura = $nomenclatura;

        return $this;
    }

    /**
     * Get nomenclatura
     *
     * @return string
     */
    public function getNomenclatura()
    {
        return $this->nomenclatura;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return TipoDocumento
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
     * Set creacion
     *
     * @param \DateTime $creacion
     *
     * @return TipoDocumento
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
     * @return TipoDocumento
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
