<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PackageTransaction
 *
 * @ORM\Table(name="package_transaction", indexes={@ORM\Index(name="package_transaction_fk0", columns={"package"}), @ORM\Index(name="package_transaction_fk1", columns={"package_status"}), @ORM\Index(name="package_transaction_fk2", columns={"transfer_status"}), @ORM\Index(name="package_transaction_fk3", columns={"courier"})})
 * @ORM\Entity
 */
class PackageTransaction
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="transaction_date", type="datetime", nullable=false)
     */
    private $transactionDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Package
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Package")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="package", referencedColumnName="id")
     * })
     */
    private $package;

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
     * Set transactionDate
     *
     * @param \DateTime $transactionDate
     *
     * @return PackageTransaction
     */
    public function setTransactionDate($transactionDate)
    {
        $this->transactionDate = $transactionDate;

        return $this;
    }

    /**
     * Get transactionDate
     *
     * @return \DateTime
     */
    public function getTransactionDate()
    {
        return $this->transactionDate;
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
     * Set package
     *
     * @param \AppBundle\Entity\Package $package
     *
     * @return PackageTransaction
     */
    public function setPackage(\AppBundle\Entity\Package $package = null)
    {
        $this->package = $package;

        return $this;
    }

    /**
     * Get package
     *
     * @return \AppBundle\Entity\Package
     */
    public function getPackage()
    {
        return $this->package;
    }

    /**
     * Set packageStatus
     *
     * @param \AppBundle\Entity\PackageStatus $packageStatus
     *
     * @return PackageTransaction
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
     * @return PackageTransaction
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
     * @return PackageTransaction
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
}
