<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PackageTag
 *
 * @ORM\Table(name="package_tag", indexes={@ORM\Index(name="package_tag_fk0", columns={"package"}), @ORM\Index(name="package_tag_fk1", columns={"tag"})})
 * @ORM\Entity
 */
class PackageTag
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
     * @var \AppBundle\Entity\Package
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Package")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="package", referencedColumnName="id")
     * })
     */
    private $package;

    /**
     * @var \AppBundle\Entity\Tag
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Tag")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tag", referencedColumnName="id")
     * })
     */
    private $tag;



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
     * @return PackageTag
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
     * Set tag
     *
     * @param \AppBundle\Entity\Tag $tag
     *
     * @return PackageTag
     */
    public function setTag(\AppBundle\Entity\Tag $tag = null)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return \AppBundle\Entity\Tag
     */
    public function getTag()
    {
        return $this->tag;
    }
}
