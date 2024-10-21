<?php
namespace Entities;
 /**
 * @Entity(repositoryClass="Repositories\SesionesRepository")
 * @Table(name="itv_sesiones")
 */
class Sesiones
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="bigint",name="itvs_id",length=20)
     * @var int
     **/
    protected $id;

    /**
     * @Column(type="integer",name="itvs_paciente")
     * @OneToOne(targetEntity="Pacientes")
     * @JoinColumn(name="itvs_paciente", referencedColumnName="itvp_id")
     * @var int
     **/

    protected $paciente;

    /**
     * @Column(type="text", name="itvs_detalle",nullable=TRUE,)
     * @var string
     **/
    protected $detalle;


    /**
     * @Column(type="datetime",name="itvs_creacion")
     **/
    protected $creacion;

    /**
     * @Column(type="datetime",name="itvs_modificacion")
     **/
    protected $modificacion;

    /**
    * @Column(type="datetime",name="itvs_fechadealta",nullable=TRUE)
    **/
    protected $fechadealta;
    /**
    * @Column(type="integer",name="itvs_estadoactual")
    * @ManyToOne(targetEntity="Estadossesion")
    * @JoinColumn(name="itvs_estadoactual", referencedColumnName="itves_id")
    * @var int
    **/
    protected $estadoactual;

    /**
    * @Column(type="boolean", name="itvs_activo",nullable=TRUE)
    * @var boolean
    **/
    protected $activo;

    /**
     * @Column(type="string",name="itvs_codigo",length=20)
     * @var string
     **/
    protected $codigo;


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
     * Set paciente
     *
     * @param integer $paciente
     *
     * @return Sesiones
     */
    public function setPaciente($paciente)
    {
        $this->paciente = $paciente;

        return $this;
    }

    /**
     * Get paciente
     *
     * @return integer
     */
    public function getPaciente()
    {
        return $this->paciente;
    }

    /**
     * Set detalle
     *
     * @param string $detalle
     *
     * @return Sesiones
     */
    public function setDetalle($detalle)
    {
        $this->detalle = $detalle;

        return $this;
    }

    /**
     * Get detalle
     *
     * @return string
     */
    public function getDetalle()
    {
        return $this->detalle;
    }

    /**
     * Set creacion
     *
     * @param \DateTime $creacion
     *
     * @return Sesiones
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
     * @return Sesiones
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
     * Set estadoactual
     *
     * @param integer $estadoactual
     *
     * @return Sesiones
     */
    public function setEstadoactual($estadoactual)
    {
        $this->estadoactual = $estadoactual;

        return $this;
    }

    /**
     * Get estadoactual
     *
     * @return integer
     */
    public function getEstadoactual()
    {
        return $this->estadoactual;
    }

    /**
     * Set fechadealta
     *
     * @param \DateTime $fechadealta
     *
     * @return Sesiones
     */
    public function setFechadealta($fechadealta)
    {
        $this->fechadealta = $fechadealta;

        return $this;
    }

    /**
     * Get fechadealta
     *
     * @return \DateTime
     */
    public function getFechadealta()
    {
        return $this->fechadealta;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     *
     * @return Sesiones
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     *
     * @return Sesiones
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean
     */
    public function getActivo()
    {
        return $this->activo;
    }
}
