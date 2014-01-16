<?php

namespace Blog\BlogBundle\Forms;

use Symfony\Component\Validator\Constraints as Assert;

class Article
{
    /**
     * @Assert\Length(
     *      min = "10"
     * )
     */
    protected $title;

    /**
     * @Assert\Length(
     *      min = "5"
     * )
     */
    protected $image;

    /**
     * @Assert\Length(
     *      min = "100"
     * )
     */
    protected $body;

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }
}