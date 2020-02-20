<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 *
 * @ORM\Table(name="address")
 * @ORM\Entity
 */
class Address
{
    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=false)
     */
    private $city;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_storage", type="integer", nullable=false)
     */
    private $isStorage;

    /**
     * @var string
     *
     * @ORM\Column(name="street_and_number", type="string", length=255, nullable=false)
     */
    private $streetAndNumber;

    /**
     * @var integer
     *
     * @ORM\Column(name="zipcode", type="integer", length=10, nullable=false)
     */
    private $zipcode;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->zipcode.' '.$this->city.' '.$this->streetAndNumber;
    }

    /**
     * Set isStorage
     *
     * @param integer $isStorage
     *
     * @return Address
     */
    public function setIsStorage($isStorage)
    {
        $this->isStorage = $isStorage;

        return $this;
    }

    /**
     * Get isStorage
     *
     * @return integer
     */
    public function getIsStorage()
    {
        return $this->isStorage;
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
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getStreetAndNumber()
    {
        return $this->streetAndNumber;
    }

    /**
     * @param string $streetAndNumber
     */
    public function setStreetAndNumber($streetAndNumber)
    {
        $this->streetAndNumber = $streetAndNumber;
    }

    /**
     * @return int
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * @param int $zipcode
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    }


}
