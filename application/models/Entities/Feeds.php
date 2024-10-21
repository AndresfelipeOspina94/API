<?php
namespace Entities;
 /**
 * @Entity(repositoryClass="Repositories\FeedsRepository")
 * @Table(name="itv_feeds")
 */
class Feeds
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer",name="itvf_id",length=11)
     * @var int
     **/
    protected $id;

    /**
     * @Column(type="text",name="itvf_url")
     * @var string
     **/
    protected $url;

    /**
     * @Column(type="datetime",name="itvf_creacion")
     **/
    protected $creacion;


    /**
     * @Column(type="datetime",name="itvf_modificacion")
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
     * Set url
     *
     * @param string $url
     *
     * @return Feeds
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }
    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return utf8_encode($this->url);
    }

    /**
     * Set creacion
     *
     * @param \DateTime $creacion
     *
     * @return Feeds
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
     * @return Feeds
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
     * @return Feeds
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
}
