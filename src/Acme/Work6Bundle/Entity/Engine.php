<?php

namespace Acme\Work6Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Engine
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Engine
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=100)
     */
    private $img;
    
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="Plane", mappedBy="engine")
     */
    protected $planes;

    public function __construct()
    {
        $this->planes = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Engine
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Engine
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add planes
     *
     * @param \Acme\Work6Bundle\Entity\Plane $planes
     * @return Engine
     */
    public function addPlane(\Acme\Work6Bundle\Entity\Plane $planes)
    {
        $this->planes[] = $planes;
    
        return $this;
    }

    /**
     * Remove planes
     *
     * @param \Acme\Work6Bundle\Entity\Plane $planes
     */
    public function removePlane(\Acme\Work6Bundle\Entity\Plane $planes)
    {
        $this->planes->removeElement($planes);
    }

    /**
     * Get planes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPlanes()
    {
        return $this->planes;
    }

    /**
     * Set img
     *
     * @param string $img
     * @return Engine
     */
    public function setImg($img)
    {
        $this->img = $img;
    
        return $this;
    }

    /**
     * Get img
     *
     * @return string 
     */
    public function getImg()
    {
        return $this->img;
    }
}