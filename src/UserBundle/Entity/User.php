<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Gedmo\Mapping\Annotation as Gedmo;
use MainBundle\Entity\Company;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 * @UniqueEntity(fields="email", message="Email already taken")
 * @UniqueEntity(fields="username", message="Username already taken")
 */
class User implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Gedmo\Slug(fields={"fname","lname","id"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

        
    /**
     * @ORM\Column(name="salt", type="string", length=255, nullable=true)
     */
    private $salt;

    /**
     * @ORM\Column(type="json_array")
     */
    private $roles = array();

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * @ORM\Column(name="username", type="string", length=255, nullable=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     *  @Assert\NotBlank
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="fname", type="string", length=255, nullable=true)
     */
    private $fname;

    /**
     * @var string
     *
     * @ORM\Column(name="lname", type="string", length=255, nullable=true)
     */
    private $lname;

    /**
     * @var bool
     *
     * @ORM\Column(name="isActive", type="boolean")
     */
    private $isActive;

    /**
     * @var bool
     *
     * @ORM\Column(name="created_on", type="datetime")
     */
    private $createdOn;

    /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Company", inversedBy="users")
     */
    private $company;

    public $companyName;

    public function __construct() {
        $this->createdOn = new \DateTime();
        $this->isActive = true;
        $this->company = new Company();
    }

    public function getCompany(){
        return $this->company;
    }

    public function setCompany($company){
        $this->company = $company;
    }

    public function getCompanyName(){
        return $this->companyName;
    }
    
    /**
     * Get id
     *
     * @return int
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
     * @return User
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
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set fname
     *
     * @param string $fname
     *
     * @return User
     */
    public function setFname($fname)
    {
        $this->fname = $fname;

        return $this;
    }

    /**
     * Get fname
     *
     * @return string
     */
    public function getFname()
    {
        return $this->fname;
    }

    /**
     * Set lname
     *
     * @param string $lname
     *
     * @return User
     */
    public function setLname($lname)
    {
        $this->lname = $lname;

        return $this;
    }

    /**
     * Get lname
     *
     * @return string
     */
    public function getLname()
    {
        return $this->lname;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return bool
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    public function setPlainPassword($plainPassword){
        $this->plainPassword = $plainPassword;
    }
    
    public function getPlainPassword(){
        return $this->plainPassword;
    }


    public function getSalt(){
        return $this->salt;
    }

    public function getUsername(){
        return $this->username;
    }

    public function setUsername($val){
        $this->username = $val;
        return $this;
    }

    public function getRoles(){
        return $this->roles;
    }

    public function setRoles(array $roles)
    {
        $this->roles = $roles;
        return $this;
    }

    public function eraseCredentials() {
        
    }

    public function getName(){
        if($this->fname != null && $this->lname != null){
            return $this->fname." ".$this->lname;
        }else if($this->fname == null && $this->lname != null){
            return $this->lname;
        }else if($this->fname != null && $this->lname == null){
            return $this->fname;
        }else{
            return $this->email;
        }
    }


    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     *
     * @return User
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
     * Set slug
     *
     * @param string $slug
     *
     * @return User
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }


}
