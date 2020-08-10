<?php 

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    /** 
     * @ORM\Column(type="string", unique=true)
     */
    protected $name;
    /** 
     * @ORM\Column(type="string", unique=true)
     */
    protected $email;
    /** 
     * @ORM\Column(type="text")
     */
    protected $password;
    /** 
     * @ORM\Column(type="string")
     */
    protected $role;
    /** 
     * @ORM\Column(type="datetime", name="created_at")
     */
    protected $createdAt;

    // .. (other code)

    public function __constructor() {
        $this->createdAt = new \DateTime('now');
    }
}
