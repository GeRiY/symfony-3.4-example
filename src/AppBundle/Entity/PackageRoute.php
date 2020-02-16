<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PackageRoute
 *
 * @ORM\Table(name="package_route", indexes={@ORM\Index(name="package_route_fk0", columns={"next_position"}), @ORM\Index(name="package_route_fk1", columns={"transaction"})})
 * @ORM\Entity
 */
class PackageRoute
{
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
     *   @ORM\JoinColumn(name="next_position", referencedColumnName="id")
     * })
     */
    private $nextPosition;

    /**
     * @var \AppBundle\Entity\PackageTransaction
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PackageTransaction")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="transaction", referencedColumnName="id")
     * })
     */
    private $transaction;



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
     * Set nextPosition
     *
     * @param \AppBundle\Entity\Address $nextPosition
     *
     * @return PackageRoute
     */
    public function setNextPosition(\AppBundle\Entity\Address $nextPosition = null)
    {
        $this->nextPosition = $nextPosition;

        return $this;
    }

    /**
     * Get nextPosition
     *
     * @return \AppBundle\Entity\Address
     */
    public function getNextPosition()
    {
        return $this->nextPosition;
    }

    /**
     * Set transaction
     *
     * @param \AppBundle\Entity\PackageTransaction $transaction
     *
     * @return PackageRoute
     */
    public function setTransaction(\AppBundle\Entity\PackageTransaction $transaction = null)
    {
        $this->transaction = $transaction;

        return $this;
    }

    /**
     * Get transaction
     *
     * @return \AppBundle\Entity\PackageTransaction
     */
    public function getTransaction()
    {
        return $this->transaction;
    }
}
