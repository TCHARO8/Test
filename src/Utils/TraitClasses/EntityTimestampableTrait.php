<?php
/**
 * Created by PhpStorm.
 * User: LANGANFIN Rogelio
 * Date: 02/01/2020
 * Time: 09:31
 */

namespace App\Utils\TraitClasses;


use Doctrine\ORM\Mapping as ORM;

trait EntityTimestampableTrait
{
    #[ORM\Column(type: 'datetime', nullable: false)]
    private $creationDate;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $dateUpdate;

    #[ORM\Column(type: 'boolean', options: ["default" => false])]
    private $deleted;


    public function __construct()
    {
        $this->dateUpdate = new \DateTime();
        $this->creationDate = new \DateTime();
        $this->deleted = false;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime
     */
    public function getcreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $creationDate
     *
     *
     * @return self
     */
    public function setcreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     *
     *
     * @return self
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * @return bool
     */
    public function isUpdatedAt()
    {
        return !!$this->dateUpdate;
    }
    /**
     * @return \DateTime
     */
    public function getdateUpdate()
    {
        return $this->dateUpdate;
    }

    /**
     * @param    \DateTime $dateUpdate
     */
    public function setdateUpdate( $dateUpdate)
    {
        $this->dateUpdate = $dateUpdate;
    }
}