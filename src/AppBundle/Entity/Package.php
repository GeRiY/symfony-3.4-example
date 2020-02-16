<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Package
 *
 * @ORM\Table(name="package", indexes={@ORM\Index(name="package_fk5", columns={"dimension"}), @ORM\Index(name="package_fk0", columns={"start_address"}), @ORM\Index(name="package_fk1", columns={"target_address"}), @ORM\Index(name="package_fk2", columns={"current_position"}), @ORM\Index(name="package_fk3", columns={"package_status"}), @ORM\Index(name="package_fk4", columns={"transfer_status"}), @ORM\Index(name="package_fk6", columns={"tag"}), @ORM\Index(name="package_fk7", columns={"courier"}), @ORM\Index(name="package_fk8", columns={"handler"})})
 * @ORM\Entity
 */
class Package
{
    /**
     * @var integer
     *
     * @ORM\Column(name="dimension", type="integer", nullable=false)
     */
    private $dimension;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="request_date", type="datetime", nullable=false)
     */
    private $requestDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="delivered_date", type="datetime", nullable=false)
     */
    private $deliveredDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="tag", type="integer", nullable=false)
     */
    private $tag;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Address
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Address")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="start_address", referencedColumnName="id")
     * })
     */
    private $startAddress;

    /**
     * @var \AppBundle\Entity\Address
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Address")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="target_address", referencedColumnName="id")
     * })
     */
    private $targetAddress;

    /**
     * @var \AppBundle\Entity\Position
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Position")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="current_position", referencedColumnName="id")
     * })
     */
    private $currentPosition;

    /**
     * @var \AppBundle\Entity\PackageStatus
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PackageStatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="package_status", referencedColumnName="id")
     * })
     */
    private $packageStatus;

    /**
     * @var \AppBundle\Entity\TransferStatus
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TransferStatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="transfer_status", referencedColumnName="id")
     * })
     */
    private $transferStatus;

    /**
     * @var \AppBundle\Entity\Courier
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Courier")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="courier", referencedColumnName="id")
     * })
     */
    private $courier;

    /**
     * @var \AppBundle\Entity\FosUser
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="handler", referencedColumnName="id")
     * })
     */
    private $handler;



    /**
     * Set dimension
     *
     * @param integer $dimension
     *
     * @return Package
     */
    public function setDimension($dimension)
    {
        $this->dimension = $dimension;

        return $this;
    }

    /**
     * Get dimension
     *
     * @return integer
     */
    public function getDimension()
    {
        return $this->dimension;
    }

    /**
     * Set requestDate
     *
     * @param \DateTime $requestDate
     *
     * @return Package
     */
    public function setRequestDate($requestDate)
    {
        $this->requestDate = $requestDate;

        return $this;
    }

    /**
     * Get requestDate
     *
     * @return \DateTime
     */
    public function getRequestDate()
    {
        return $this->requestDate;
    }

    /**
     * Set deliveredDate
     *
     * @param \DateTime $deliveredDate
     *
     * @return Package
     */
    public function setDeliveredDate($deliveredDate)
    {
        $this->deliveredDate = $deliveredDate;

        return $this;
    }

    /**
     * Get deliveredDate
     *
     * @return \DateTime
     */
    public function getDeliveredDate()
    {
        return $this->deliveredDate;
    }

    /**
     * Set tag
     *
     * @param integer $tag
     *
     * @return Package
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return integer
     */
    public function getTag()
    {
        return $this->tag;
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
     * Set startAddress
     *
     * @param \AppBundle\Entity\Address $startAddress
     *
     * @return Package
     */
    public function setStartAddress(\AppBundle\Entity\Address $startAddress = null)
    {
        $this->startAddress = $startAddress;

        return $this;
    }

    /**
     * Get startAddress
     *
     * @return \AppBundle\Entity\Address
     */
    public function getStartAddress()
    {
        return $this->startAddress;
    }

    /**
     * Set targetAddress
     *
     * @param \AppBundle\Entity\Address $targetAddress
     *
     * @return Package
     */
    public function setTargetAddress(\AppBundle\Entity\Address $targetAddress = null)
    {
        $this->targetAddress = $targetAddress;

        return $this;
    }

    /**
     * Get targetAddress
     *
     * @return \AppBundle\Entity\Address
     */
    public function getTargetAddress()
    {
        return $this->targetAddress;
    }

    /**
     * Set currentPosition
     *
     * @param \AppBundle\Entity\Position $currentPosition
     *
     * @return Package
     */
    public function setCurrentPosition(\AppBundle\Entity\Position $currentPosition = null)
    {
        $this->currentPosition = $currentPosition;

        return $this;
    }

    /**
     * Get currentPosition
     *
     * @return \AppBundle\Entity\Position
     */
    public function getCurrentPosition()
    {
        return $this->currentPosition;
    }

    /**
     * Set packageStatus
     *
     * @param \AppBundle\Entity\PackageStatus $packageStatus
     *
     * @return Package
     */
    public function setPackageStatus(\AppBundle\Entity\PackageStatus $packageStatus = null)
    {
        $this->packageStatus = $packageStatus;

        return $this;
    }

    /**
     * Get packageStatus
     *
     * @return \AppBundle\Entity\PackageStatus
     */
    public function getPackageStatus()
    {
        return $this->packageStatus;
    }

    /**
     * Set transferStatus
     *
     * @param \AppBundle\Entity\TransferStatus $transferStatus
     *
     * @return Package
     */
    public function setTransferStatus(\AppBundle\Entity\TransferStatus $transferStatus = null)
    {
        $this->transferStatus = $transferStatus;

        return $this;
    }

    /**
     * Get transferStatus
     *
     * @return \AppBundle\Entity\TransferStatus
     */
    public function getTransferStatus()
    {
        return $this->transferStatus;
    }

    /**
     * Set courier
     *
     * @param \AppBundle\Entity\Courier $courier
     *
     * @return Package
     */
    public function setCourier(\AppBundle\Entity\Courier $courier = null)
    {
        $this->courier = $courier;

        return $this;
    }

    /**
     * Get courier
     *
     * @return \AppBundle\Entity\Courier
     */
    public function getCourier()
    {
        return $this->courier;
    }

    /**
     * Set handler
     *
     * @param \AppBundle\Entity\FosUser $handler
     *
     * @return Package
     */
    public function setHandler(\AppBundle\Entity\FosUser $handler = null)
    {
        $this->handler = $handler;

        return $this;
    }

    /**
     * Get handler
     *
     * @return \AppBundle\Entity\FosUser
     */
    public function getHandler()
    {
        return $this->handler;
    }
}
