<?php 

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="comments")
 */
class Comment
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    /** 
     * @ORM\Column(type="integer", name="post_id")
     */
    protected $postId;
    /** 
     * @ORM\Column(type="integer", name="owner_id")
     */
    protected $ownerId;
    /** 
     * @ORM\Column(type="text")
     */
    protected $body;
    /** 
     * @ORM\Column(type="datetime", name="created_at")
     */
    protected $createdAt;
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    protected $user;
    /**
     * @ORM\ManyToOne(targetEntity="Post")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     */
    protected $post;

    public function __constructor() {
        $this->createdAt = new \DateTime('now');
    }
}
