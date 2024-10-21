<?php
namespace Entities;
 /**
 * @Entity(repositoryClass="Repositories\ChatsRepository")
 * @Table(name="itv_chats")
 */
class Chats
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="bigint",name="itvch_id",length=20)
     * @var int
     **/
    protected $id;

    /**
       * @Column(type="integer",name="itvch_idsesion")
       * @ManyToOne(targetEntity="Sesiones")
       * @JoinColumn(name="itvch_idsesion", referencedColumnName="itvs_id")
       * @var int
       **/
      protected $sesion;

    /**
       * @Column(type="integer",name="itvch_idpaciente")
       * @ManyToOne(targetEntity="Pacientes")
       * @JoinColumn(name="itvch_idpaciente", referencedColumnName="itvp_id")
       * @var int
       **/
      protected $paciente;

    /**
       * @Column(type="integer",name="itvch_idadmin")
       * @var int
       **/
      protected $admin;

    /**
     * @Column(type="text", name="itvch_mensaje")
     * @var string
     **/
    protected $mensaje;

    /**
     * @Column(type="text", name="itvch_foto")
     * @var string
     **/
    protected $foto;

    /**
     * @Column(type="integer",name="itvch_visto")
     * @var integer
     **/
    protected $visto;


    /**
     * @Column(type="datetime",name="itvch_creacion")
     **/
    protected $creacion;

    /**
     * @Column(type="datetime",name="itvch_modificacion")
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
     * Set sesion
     *
     * @param integer $sesion
     *
     * @return Chats
     */
    public function setSesion($sesion)
    {
        $this->sesion = $sesion;

        return $this;
    }

    /**
     * Get sesion
     *
     * @return integer
     */
    public function getSesion()
    {
        return $this->sesion;
    }

    /**
     * Set paciente
     *
     * @param integer $paciente
     *
     * @return Chats
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
     * Set admin
     *
     * @param integer $admin
     *
     * @return Chats
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;

        return $this;
    }

    /**
     * Get admin
     *
     * @return integer
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Set mensaje
     *
     * @param string $mensaje
     *
     * @return Chats
     */
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;

        return $this;
    }

    /**
     * Get mensaje
     *
     * @return string
     */
    public function getMensaje()
    {
        return $this->mensaje;
    }

    /**
     * Set foto
     *
     * @param string $foto
     *
     * @return Chats
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get foto
     *
     * @return string
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set visto
     *
     * @param integer $visto
     *
     * @return Chats
     */
    public function setVisto($visto)
    {
        $this->visto = $visto;

        return $this;
    }

    /**
     * Get visto
     *
     * @return integer
     */
    public function getVisto()
    {
        return $this->visto;
    }

    /**
     * Set creacion
     *
     * @param \DateTime $creacion
     *
     * @return Chats
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
     * @return Chats
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
