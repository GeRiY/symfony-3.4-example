<?php
namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="fos_user")
*/
class User extends BaseUser
{
/**
* @ORM\Id
* @ORM\Column(type="integer")
* @ORM\GeneratedValue(strategy="AUTO")
*/
protected $id;

    /**
     * @var \AppBundle\Entity\Address
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Address")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="address", referencedColumnName="id")
     * })
     */
    protected $address;

    /**
     * @var \AppBundle\Entity\UserRole
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\UserRole")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role", referencedColumnName="id")
     * })
     */
    protected $role;

public function __construct()
{
parent::__construct();
// your own logic
}

    /**
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param Address $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return UserRole
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param UserRole $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }



}