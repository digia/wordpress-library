<?php

namespace Digia\Foundation\Mail;

use Swift_SmtpTransport;
use Swift_MailTransport;
use Swift_Mailer;
use Swift_Message;

abstract class Mailer 
{
    const CONTENT_TYPE = 'html';

    protected $smtpConfig = array(
        'host' => '',
        'port' => '',
        'username' => '',
        'password' => '',
    );

    /**
     * Send an email to someone
     *
     * @return int number of emails sent
     */
    public function sendTo($to, $from, $subject, $body)
    {
        $mailer = $this->getMailer(); 

        $message = $this->buildMessage($to, $from, $subject, $body);

        return $mailer->send($message);
    }

    /**
     * Get the mailer 
     *
     * @return Swift_Mailer
     */
    protected function getMailer($service = 'mail')
    {
        switch ($service) {
            case 'smtp':
                $transport = $this->getSmtpTransport(); 
                break;
            case 'mail': 
                $transport = $this->getMailTransport();
                break;
            default: 
                $transport = $this->getSmtpTransport(); 
        }

       return Swift_Mailer::newInstance($transport);
    }

    /**
     * Build the mail message
     *
     * @return Swift_Message
     */
    protected function buildMessage($to, $from, $subject, $body)
    {
        $message = Swift_Message::newInstance($subject)
            ->setFrom($from)
            ->setTo($to)
            ->setBody($body); 

        if (strtolower(self::CONTENT_TYPE) === 'html') {
            $this->setContentTypeToHtml($message);
        }

        return $message;
    }

    /**
     * Set the message content-type to html
     *
     */
    protected function setContentTypeToHtml($message)
    {
        $contentType = $message->getHeaders()->get('Content-Type');
        $contentType->setValue('text/html');
        $contentType->setParameter('charset', 'utf-8');
    }

    /**
     * Get the SMTP transport
     *
     * @return Swift_SmtpTransport
     */
    protected function getSmtpTransport()
    {
        $transport = Swift_SmtpTransport::newInstance($this->smtpConfig['host'], $this->smtpConfig['port']);

        if ( ! empty($this->smtpConfig['username'])) $transport->setUsername($this->smtpConfig['username']);

        if ( ! empty($this->smtpConfig['password'])) $transport->setPassword($this->smtpConfig['password']);

        return $transport;
    }

    /**
     * Get the mail transport
     *
     * @return Swift_MailTransport
     */
    protected function getMailTransport()
    {
        return Swift_MailTransport::newInstance(); 
    }
}
