<?php
namespace Entities;
 /**
 * @Entity(repositoryClass="Repositories\SliderRepository")
 * @Table(name="itv_sliders")
 */
class Slider
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer",name="itvsl_id",length=11)
     * @var int
     **/
    protected $id;

    /**
     * @Column(type="string",name="itvsl_imagenslider",length=50,nullable=TRUE)
     * @var string
     **/
    protected $imagenslider;

    /**
     * @Column(type="string",name="itvsl_videoslider",length=255,nullable=TRUE)
     * @var string
     **/
    protected $videoslider;

    /**
     * @Column(type="integer",name="itvsl_tiempopermanencia",length=4)
     * @var int
     **/
    protected $tiempopermanencia;

    /**
     * @Column(type="datetime",name="itvsl_creacion")
     **/
    protected $creacion;


    /**
     * @Column(type="datetime",name="itvsl_modificacion")
     **/
    protected $modificacion;

    /**
     * @Column(type="boolean", name="itvsl_estado",nullable=TRUE)
     * @var boolean
     **/
    protected $estado;


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
     * Set imagensldier
     *
     * @param integer $imagenslider
     *
     * @return Slider
     */
    public function setImagen($imagenslider)
    {
        $this->imagenslider = $imagenslider;

        return $this;
    }

    /**
     * Get imagenslider
     *
     * @return integer
     */
    public function getImagen()
    {
        return $this->$imagenslider;
    }

    /**
     * Set tiempopermanencia
     *
     * @param integer $tiempopermanencia
     *
     * @return Slider
     */
    public function setTiempopermanencia($tiempopermanencia)
    {
        $this->tiempopermanencia = $tiempopermanencia;

        return $this;
    }

    /**
     * Get tiempopermanencia
     *
     * @return integer
     */
    public function getTiempopermanencia()
    {
        return $this->tiempopermanencia;
    }

    /**
     * Set creacion
     *
     * @param \DateTime $creacion
     *
     * @return Slider
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
     * @return Slider
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
     * @return Slider
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
     * Set imagenslider
     *
     * @param string $imagenslider
     *
     * @return Slider
     */
    public function setImagenslider($imagenslider)
    {
        $this->imagenslider = $imagenslider;

        return $this;
    }

    /**
     * Get imagenslider
     *
     * @return string
     */
    public function getImagenslider()
    {
        return $this->imagenslider;
    }

    /**
     * Set videoslider
     *
     * @param string $videoslider
     *
     * @return Slider
     */
    public function setVideoslider($videoslider)
    {
        $this->videoslider = $videoslider;

        return $this;
    }

    /**
     * Get videoslider
     *
     * @return string
     */
    public function getVideoslider()
    {
        return $this->videoslider;
    }
}
