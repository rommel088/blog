<?php

namespace Acme\Work6Bundle\Services;


class MyMailer {

    protected $mailer;
    protected $subject;
    protected $addressTo;
    protected $addressFrom;
    protected $body;

    public function __construct($mailer)
    {
        $this->mailer = $mailer;
    }

    public function setParameters($params)
    {
        $this->subject = $params['name'];
        $this->addressTo = $params['mail'];
        $this->addressFrom = $params['receiver'];
        $this->body = $params['text'];
    }

    public function sendMail()
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($this->subject)
            ->setFrom($this->addressFrom)
            ->setTo($this->addressTo)
            ->setBody($this->body)
        ;
        $this->mailer->send($message);

        return "okay";
    }
} 