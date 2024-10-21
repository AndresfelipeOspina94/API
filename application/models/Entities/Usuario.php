<?php
namespace Entities;
 /**
 * @Entity(repositoryClass="Repositories\UsuarioRepository")
 * @Table(name="app_usuarios")
 */
class Usuario
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer",name="au_id",length=6)
     * @var int
     **/
    protected $id;

    /**
     * @Column(type="string",name="au_password",length=100)
     * @var string
     **/
    protected $password;

    /**
     * @Column(type="string",name="au_token",length=100)
     * @var string
     **/
    protected $token;

    /**
     * @Column(type="datetime",name="au_creacion")
     **/
    protected $creacion;


    /**
     * @Column(type="datetime",name="au_modificacion")
     **/
    protected $modificacion;

    /**
     * @Column(type="boolean", name="au_estado",nullable=TRUE)
     * @var boolean
     **/
    protected $estado;


    /**
     * @Column(type="integer",name="au_perfiladministrativo")
     * @ManyToOne(targetEntity="PerfilAdministrativo")
     * @JoinColumn(name="au_perfiladministrativo", referencedColumnName="apa_id")
     * @var int
     **/
    protected $perfiladministrativo;

    /**
     * @Column(type="integer",name="au_cliente")
     * @OneToOne(targetEntity="Cliente")
     * @JoinColumn(name="au_cliente", referencedColumnName="ac_id")
     * @var int
     **/

    protected $cliente;

    public function __construct()
    {
        $this->creacion = new \DateTime("now");
        $this->modificacion = new \DateTime("now");
        // $nowTime=new \DateTime("now");
        // var_dump($nowTime);
        $this->token = md5(time());
        //$this->estado = true;
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
     * Set password
     *
     * @param string $password
     *
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set token
     *
     * @param string $token
     *
     * @return Usuario
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set creacion
     *
     * @param \DateTime $creacion
     *
     * @return Usuario
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
     * @return Usuario
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
     * Set estado
     *
     * @param boolean $estado
     *
     * @return Usuario
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set perfiladministrativo
     *
     * @param integer $perfiladministrativo
     *
     * @return Usuario
     */
    public function setPerfiladministrativo($perfiladministrativo)
    {
        $this->perfiladministrativo = $perfiladministrativo;

        return $this;
    }

    /**
     * Get perfiladministrativo
     *
     * @return integer
     */
    public function getPerfiladministrativo()
    {
        return $this->perfiladministrativo;
    }

    /**
     * Set cliente
     *
     * @param integer $cliente
     *
     * @return Usuario
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get cliente
     *
     * @return integer
     */
    public function getCliente()
    {
        return $this->cliente;
    }
}
