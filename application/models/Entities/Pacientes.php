<?php
namespace Entities;
 /**
 * @Entity(repositoryClass="Repositories\PacientesRepository")
 * @Table(name="itv_pacientes")
 */
class Pacientes
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="bigint",name="itvp_id",length=20)
     * @var int
     **/
    protected $id;

    /**
     * @Column(type="string",name="itvp_cedula",length=50)
     * @var string
     **/
    protected $cedula;

    /**
     * @Column(type="string",name="itvp_nombres",length=100)
     * @var string
     **/
    protected $nombres;

    /**
     * @Column(type="string",name="itvp_apellidos",length=100)
     * @var string
     **/
    protected $apellidos;


    /**
       * @Column(type="integer",name="itvp_estadoactual")
       * @ManyToOne(targetEntity="Estadossesion")
       * @JoinColumn(name="itvp_estadoactual", referencedColumnName="itves_id")
       * @var int
       **/
    protected $estadoactual;

    /**
     * @Column(type="datetime",name="itvp_creacion")
     **/
    protected $creacion;

    /**
     * @Column(type="datetime",name="itvp_modificacion")
     **/
    protected $modificacion;


    public function __construct()
    {
        $this->creacion = new \DateTime("now");
        $this->modificacion = new \DateTime("now");
        $this->estadoactual = 1;//
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
     * Set cedula
     *
     * @param string $cedula
     *
     * @return Pacientes
     */
    public function setCedula($cedula)
    {
        $this->cedula = $cedula;

        return $this;
    }

    /**
     * Get cedula
     *
     * @return string
     */
    public function getCedula()
    {
        return $this->cedula;
    }

    /**
     * Set nombres
     *
     * @param string $nombres
     *
     * @return Pacientes
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;

        return $this;
    }

    /**
     * Get nombres
     *
     * @return string
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return Pacientes
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set estadoactual
     *
     * @param integer $estadoactual
     *
     * @return Pacientes
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
     * Set creacion
     *
     * @param \DateTime $creacion
     *
     * @return Pacientes
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
     * @return Pacientes
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
