<?php
namespace Entities;

/**
 * @Entity(repositoryClass="Repositories\KeysRepository")
 * @Table(name="app_keys")
 */
class Keys
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer",name="ak_id")
     * @var int
     **/
    protected $id;

  /**
   *@Column(type="string",name="ak_key",length=100)
   * @var string
   **/
  protected $token;

  /**
   * @Column(type="integer",name="ak_ignore_limits")
   * @var int
   **/
  protected $ignorelimits;

  /**
   * @Column(type="integer",name="ak_date_created")
   **/
  protected $created;

  public function __construct()
  {
      $this->created=0;
      $this->ignorelimits=0;
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
     * Set token
     *
     * @param string $token
     *
     * @return Keys
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
     * Set ignorelimits
     *
     * @param integer $ignorelimits
     *
     * @return Keys
     */
    public function setIgnorelimits($ignorelimits)
    {
        $this->ignorelimits = $ignorelimits;

        return $this;
    }

    /**
     * Get ignorelimits
     *
     * @return integer
     */
    public function getIgnorelimits()
    {
        return $this->ignorelimits;
    }

    /**
     * Set created
     *
     * @param integer $created
     *
     * @return Keys
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return integer
     */
    public function getCreated()
    {
        return $this->created;
    }
}
