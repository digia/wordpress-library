<?php

namespace Digia\WordPress\Mail;

use Digia\WordPress\Mail\Mailer;

class ContactMailer extends Mailer
{
    /**
     * Send a new contact email
     *
     * @return int total emails that were sent
     */
    public function contact(array $data)
    {
        $to = $this->getWpAdminEmail();
        $from = '';
        $subject = $this->buildContactSubject($data);
        $body = $this->buildContactBody($data);

        return $this->sendTo($to, $from, $subject, $body); 
    }

    /**
     * Build the emails subject line
     *
     * @return string subject line
     */
    protected function buildContactSubject(array $data)
    {
        $info = $this->getWpSiteInformation();

        return 'Website Contact: '.htmlspecialchars($data['fullName']).' - '.$info['name'];
    }

    /**
     * Build the html body for the contact message
     *
     * @return string html string 
     */
    protected function buildContatBody(array $data)
    {
        $info = $this->getWpSiteInformation();

        $input = [];
        foreach ($data as $field => $value) {
            if ('message' == $field) {
                $value = strip_tags(stripcslashes($value));
            }

            $input[$field] = htmlspecialchars($value);
        }

        $html = '<p>New message from '.$input['fullName'].' sent via the contact form on <a href="'.$info['url'].'">'.$info['name'].'</a>!</p>';
        $html .= '<b>Full Name:</b> '.$input['fullName'].'<br>';
        $html .= '<b>Email:</b> <a href="mailto:'.$input['email'].'">'.$input['email'].'</a><br>';
        $html .= '<b>Phone:</b> '.$input['phone'].'<br>';
        $html .= '<b>Message</b> '.$input['message'].'<br>';
        $html .= '<br><hr><p><em>This message was sent from '.$_SERVER['REMOTE_ADDR'].'.</em></p>';

        return $html;
    }

}
