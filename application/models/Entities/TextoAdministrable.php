<?php
namespace Entities;
 /**
 * @Entity(repositoryClass="Repositories\TextoAdministrableRepository")
 * @Table(name="itv_textoadministrable")
 */
class TextoAdministrable
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer",name="itvta_id",length=11)
     * @var int
     **/
    protected $id;

    /**
     * @Column(type="text",name="itvta_agradecimiento")
     * @var string
     **/
    protected $agradecimiento;

    /**
     * @Column(type="text",name="itvta_orientacion")
     * @var string
     **/
    protected $orientacion;

    /**
     * @Column(type="datetime",name="itvta_creacion")
     **/
    protected $creacion;


    /**
     * @Column(type="datetime",name="itvta_modificacion")
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
     * Set agradecimiento
     *
     * @param string $agradecimiento
     *
     * @return TextoAdministrable
     */
    public function setAgradecimiento($agradecimiento)
    {
        $this->agradecimiento = $agradecimiento;
        return $this;
    }
    /**
     * Get agradecimiento
     *
     * @return string
     */
    public function getAgradecimiento()
    {
        return utf8_encode($this->agradecimiento);
    }

    /**
     * Set orientacion
     *
     * @param string $orientacion
     *
     * @return TextoAdministrable
     */
    public function setDescripcion($orientacion)
    {
        $this->orientacion = $orientacion;
        return $this;
    }
    /**
     * Get orientacion
     *
     * @return string
     */
    public function getOrientacion()
    {
        return utf8_encode($this->orientacion);
    }


    /**
     * Set creacion
     *
     * @param \DateTime $creacion
     *
     * @return TextoAdministrable
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
     * @return TextoAdministrable
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
     * Set orientacion
     *
     * @param string $orientacion
     *
     * @return TextoAdministrable
     */
    public function setOrientacion($orientacion)
    {
        $this->orientacion = $orientacion;

        return $this;
    }
}
