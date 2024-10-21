<?php
namespace Entities;
 /**
 * @Entity(repositoryClass="Repositories\EmpleadoRepository")
 * @Table(name="app_empleados")
 */
class Empleado
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer",name="ac_id",length=6)
     * @var int
     **/
    protected $id;

    /**
     * @Column(type="integer",name="ac_tipodocumento")
     * @ManyToOne(targetEntity="TipoDocumento")
     * @JoinColumn(name="ac_tipodocumento", referencedColumnName="atd_id")
     * @var int
     **/
    protected $tipodocumento;

    /**
     * @Column(type="string", name="ac_documento",length=100)
     **/
    protected $documento;

    /**
     * @Column(type="string", name="ac_nombres",length=100, options={"collation":"utf8_unicode_ci"})
     * @var string
     **/
    protected $nombres;

    /**
     * @Column(type="string", name="ac_apellidos",length=100, options={"collation":"utf8_unicode_ci"})
     * @var string
     **/
    protected $apellidos;

    /**
     * @Column(type="string", name="ac_direccion",nullable=TRUE,  options={"collation":"utf8_unicode_ci"})
     * @var string
     **/
    protected $direccion;

    /**
     * @Column(type="string", name="ac_telefono",length=100)
     **/
    protected $telefono;
    /**
     * @Column(type="string",nullable=TRUE, name="ac_telefonoalternativo",length=100,nullable=TRUE)
     **/
    protected $telefonoalternativo;

    /**
     * @Column(type="integer",nullable=TRUE,name="ac_tipocliente")
     * @var int
     **/
    protected $tipocliente;

    /**
     * @Column(type="integer",name="ac_ciudad")
     * @ManyToOne(targetEntity="Ciudad")
     * @JoinColumn(name="ac_ciudad", referencedColumnName="ac_id")
     * @var int
     **/
    protected $ciudad;

    /**
     * @Column(type="string", name="ac_emailprincipal",length=50)
     * @var string
     **/
    protected $emailprincipal;

    /**
     * @Column(type="string",nullable=TRUE,name="ac_imagen",length=500)
     * @var string
     **/
    protected $imagen;

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
        // $nowTime=new \DateTime("now");
        // var_dump($nowTime);
        $this->token = md5(time());
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
     * Set emailprincipal
     *
     * @param string $emailprincipal
     *
     * @return Empleado
     */
    public function setEmailprincipal($emailprincipal)
    {
        $this->emailprincipal = $emailprincipal;

        return $this;
    }

    /**
     * Get emailprincipal
     *
     * @return string
     */
    public function getEmailprincipal()
    {
        return $this->emailprincipal;
    }

    /**
     * Set nombres
     *
     * @param string $nombres
     *
     * @return Empleado
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
        return utf8_encode($this->nombres);
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return Empleado
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
        return utf8_encode($this->apellidos);
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Empleado
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
     * @return Empleado
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
     * Set ciudad
     *
     * @param integer $ciudad
     *
     * @return Empleado
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get ciudad
     *
     * @return integer
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set documento
     *
     * @param string $documento
     *
     * @return Empleado
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;

        return $this;
    }

    /**
     * Get documento
     *
     * @return string
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * Set tipodocumento
     *
     * @param integer $tipodocumento
     *
     * @return Empleado
     */
    public function setTipodocumento($tipodocumento)
    {
        $this->tipodocumento = $tipodocumento;

        return $this;
    }

    /**
     * Get tipodocumento
     *
     * @return integer
     */
    public function getTipodocumento()
    {
        return $this->tipodocumento;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Empleado
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set creacion
     *
     * @param \DateTime $creacion
     *
     * @return Empleado
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
     * Set token
     *
     * @param string $token
     *
     * @return Empleado
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
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Empleado
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set telefonoalternativo
     *
     * @param string $telefonoalternativo
     *
     * @return Empleado
     */
    public function setTelefonoalternativo($telefonoalternativo)
    {
        $this->telefonoalternativo = $telefonoalternativo;

        return $this;
    }

    /**
     * Get telefonoalternativo
     *
     * @return string
     */
    public function getTelefonoalternativo()
    {
        return $this->telefonoalternativo;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     *
     * @return Empleado
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set tipocliente
     *
     * @param integer $tipocliente
     *
     * @return Empleado
     */
    public function setTipocliente($tipocliente)
    {
        $this->tipocliente = $tipocliente;

        return $this;
    }

    /**
     * Get tipocliente
     *
     * @return integer
     */
    public function getTipocliente()
    {
        return $this->tipocliente;
    }
}
