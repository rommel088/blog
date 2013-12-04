<?php

namespace Acme\Work6Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Plane
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Plane
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
     * @var array
     *
     * @ORM\Column(name="tth", type="json_array")
     */
    private $tth;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="Engine", inversedBy="planes")
     * @ORM\JoinColumn(name="engine_id", referencedColumnName="id")
     */
    private $engine_id;

    /**
    * @ORM\ManyToMany(targetEntity="Weapons", inversedBy="plane")
    * @ORM\JoinTable(name="planes_weapons")
    **/
    private $weapons;

    public function __construct() {
//        $this->$weapons = new ArrayCollection();
        $this->engine_id = new ArrayCollection();
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
     * @return Plane
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
     * @return Plane
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
     * Set tth
     *
     * @param array $tth
     * @return Plane
     */
    public function setTth($tth)
    {
        $this->tth = $tth;
    
        return $this;
    }

    /**
     * Get tth
     *
     * @return array 
     */
    public function getTth()
    {
        return $this->tth;
    }

    /**
     * Set engine_id
     *
     * @param \Acme\Work6Bundle\Entity\Engine $engineId
     * @return Plane
     */
    public function setEngineId(\Acme\Work6Bundle\Entity\Engine $engineId = null)
    {
        $this->engine_id = $engineId;
    
        return $this;
    }

    /**
     * Get engine_id
     *
     * @return \Acme\Work6Bundle\Entity\Engine 
     */
    public function getEngineId()
    {
        return $this->engine_id;
    }

    /**
     * Add weapons
     *
     * @param \Acme\Work6Bundle\Entity\Weapons $weapons
     * @return Plane
     */
    public function addWeapon(\Acme\Work6Bundle\Entity\Weapons $weapons)
    {
        $this->weapons[] = $weapons;
    
        return $this;
    }

    /**
     * Remove weapons
     *
     * @param \Acme\Work6Bundle\Entity\Weapons $weapons
     */
    public function removeWeapon(\Acme\Work6Bundle\Entity\Weapons $weapons)
    {
        $this->weapons->removeElement($weapons);
    }

    /**
     * Get weapons
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getWeapons()
    {
        return $this->weapons;
    }

    /**
     * Set img
     *
     * @param string $img
     * @return Plane
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