<?php
namespace Entities;
 /**
 * @Entity(repositoryClass="Repositories\TextoRotativoRepository")
 * @Table(name="itv_textorotativo")
 */
class TextoRotativo
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer",name="itvtr_id",length=11)
     * @var int
     **/
    protected $id;

    /**
     * @Column(type="string",name="itvtr_asunto",length=100)
     * @var string
     **/
    protected $asunto;

    /**
     * @Column(type="text",name="itvtr_descripcion")
     * @var string
     **/
    protected $descripcion;

    /**
    * @Column(type="boolean", name="itvtr_activo",nullable=TRUE)
    * @var boolean
    **/
    protected $activo;


    /**
     * @Column(type="datetime",name="itvtr_creacion")
     **/
    protected $creacion;


    /**
     * @Column(type="datetime",name="itvtr_modificacion")
     **/
    protected $modificacion;



    public function __construct()
    {
        $this->creacion = new \DateTime("now");
        $this->modificacion = new \DateTime("now");
        $this->estado = true;
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
     * Set asunto
     *
     * @param string $asunto
     *
     * @return TextoRotativo
     */
    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;
        return $this;
    }
    /**
     * Get asunto
     *
     * @return string
     */
    public function getAsunto()
    {
        return utf8_encode($this->asunto);
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return TextoRotativo
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
        return utf8_encode($this->descripcion);
    }

    /**
     * Set creacion
     *
     * @param \DateTime $creacion
     *
     * @return TextoRotativo
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
     * @return TextoRotativo
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
     * Set tiempo
     *
     * @param integer $tiempo
     *
     * @return TextoRotativo
     */
    public function setTiempo($tiempo)
    {
        $this->tiempo = $tiempo;

        return $this;
    }

    /**
     * Get tiempo
     *
     * @return integer
     */
    public function getTiempo()
    {
        return $this->tiempo;
    }

    /**
     * Set activo
     *
     * @param integer $activo
     *
     * @return TextoRotativo
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return integer
     */
    public function getActivo()
    {
        return $this->activo;
    }
}
