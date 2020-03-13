<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UserBundle\Utils\DateUtils;

/**
 *
 * @ORM\Table(name="password_request")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\PasswordRequestRepository")
 */
class PasswordRequest{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="email", type="string")
     */
    private $email;

    /**
     * @ORM\Column(name="token", type="string")
     */
    private $token;

    /**
     * @ORM\Column(name="createdOn", type="datetime")
     */
    private $createdOn;

    /**
     * @ORM\Column(name="expiredOn", type="datetime")
     */
    private $expiredOn;

    public function __construct(){
        $this->createdOn = new \DateTime("now");
        $this->token = sha1(uniqid().uniqid().uniqid());
        $this->expiredOn = DateUtils::getExpiredOnDateTime();
        
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
     * Set email
     *
     * @param string $email
     *
     * @return PasswordRequest
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set token
     *
     * @param string $token
     *
     * @return PasswordRequest
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
     * Set createdOn
     *
     * @param \DateTime $createdOn
     *
     * @return PasswordRequest
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * Get createdOn
     *
     * @return \DateTime
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Set expiredOn
     *
     * @param \DateTime $expiredOn
     *
     * @return PasswordRequest
     */
    public function setExpiredOn($expiredOn)
    {
        $this->expiredOn = $expiredOn;

        return $this;
    }

    /**
     * Get expiredOn
     *
     * @return \DateTime
     */
    public function getExpiredOn()
    {
        return $this->expiredOn;
    }
}
