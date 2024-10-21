<?php
namespace Entities;
 /**
 * @Entity(repositoryClass="Repositories\HistorialsesionRepository")
 * @Table(name="itv_historialsesiones")
 */
class Historialsesion
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="bigint",name="itvhs_id",length=20)
     * @var int
     **/
    protected $id;

    /**
       * @Column(type="integer",name="itvhs_idsesion")
       * @ManyToOne(targetEntity="Sesiones")
       * @JoinColumn(name="itvhs_idsesion", referencedColumnName="itvs_id")
       * @var int
       **/
      protected $sesion;


      /**
         * @Column(type="integer",name="itvhs_idestadosesion")
         * @ManyToOne(targetEntity="Estadossesion")
         * @JoinColumn(name="itvhs_idestadosesion", referencedColumnName="itves_id")
         * @var int
         **/
        protected $estadosesion;

    // /**
    //  * @Column(type="text", name="itvhs_detalle",nullable=TRUE,)
    //  * @var string
    //  **/
    // protected $detalle;

    /**
     * @Column(type="datetime",name="itvhs_creacion")
     **/
    protected $creacion;

    /**
     * @Column(type="datetime",name="itvhs_modificacion")
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
     * @param integer $idsesion
     *
     * @return Historialsesion
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
     * Set estadosesion
     *
     * @param integer $idestadosesion
     *
     * @return Historialsesion
     */
    public function setEstadosesion($estadosesion)
    {
        $this->estadosesion = $estadosesion;

        return $this;
    }

    /**
     * Get estadosesion
     *
     * @return integer
     */
    public function getEstadosesion()
    {
        return $this->estadosesion;
    }


    // /**
    //  * Set detalle
    //  *
    //  * @param string $detalle
    //  *
    //  * @return Historialsesiones
    //  */
    // public function setDetalle($detalle)
    // {
    //     $this->detalle = $detalle;
    //
    //     return $this;
    // }
    //
    // /**
    //  * Get detalle
    //  *
    //  * @return string
    //  */
    // public function getDetalle()
    // {
    //     return $this->detalle;
    // }

    /**
     * Set creacion
     *
     * @param \DateTime $creacion
     *
     * @return Historialsesion
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
     * @return Historialsesion
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
