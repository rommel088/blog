<?php

namespace Blog\BlogBundle\Forms;

use Symfony\Component\Validator\Constraints as Assert;

class Guest
{
    /**
     * @Assert\Regex(
     *     pattern="/^[a-zA-ZА-Яа-я]+$/",
     *     message="Your name must contain only letters"
     * )
     */
    protected $name;

    /**
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     */
    protected $email;

    /**
     * @Assert\Length(
     *      min = "10"
     * )
     */
    protected $message;

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
} 