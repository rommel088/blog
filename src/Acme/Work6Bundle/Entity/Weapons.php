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
class Weapons
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
     * @ORM\ManyToMany(targetEntity="Plane", mappedBy="weapons")
     **/
    private $plane;

    public function __construct() {
        $this->plane = new ArrayCollection();
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
     * @return Weapons
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
     * @return Weapons
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
     * Add plane
     *
     * @param \Acme\Work6Bundle\Entity\Plane $plane
     * @return Weapons
     */
    public function addPlane(\Acme\Work6Bundle\Entity\Plane $plane)
    {
        $this->plane[] = $plane;
    
        return $this;
    }

    /**
     * Remove plane
     *
     * @param \Acme\Work6Bundle\Entity\Plane $plane
     */
    public function removePlane(\Acme\Work6Bundle\Entity\Plane $plane)
    {
        $this->plane->removeElement($plane);
    }

    /**
     * Get plane
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPlane()
    {
        return $this->plane;
    }

    /**
     * Set img
     *
     * @param string $img
     * @return Weapons
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