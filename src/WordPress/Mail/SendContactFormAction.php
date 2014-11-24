<?php

namespace Digia\WordPress\Mail;

use Digia\WordPress\Api\Response;

class SendContactFormAction 
{
    public static function send() 
    {
        // TODO: Nonce isn't working with Ajax
        // ! wp_verify_nonce($_POST['contact-form-nonce'], $_POST['action']
        if (empty($_POST)) {
            die();
        }

        $mailer = new ContactMailer;
        $validator = new ContactEmailValidator;
        $response = new Response;

        $data = array(
            'fullName' => $_POST['contact-fullName'],
            'phone' => $_POST['contact-phone'],
            'email' => $_POST['contact-email'],
            'message' => $_POST['contact-message']
        );

        if ( ! $validator->validate($data)) {
            $errors = $validator->getErrors();

            $response->setStatus('failed')
                     ->setErrors($errors);

            echo $response->respond();
            return false;
        }

        $result = $mailer->contact($data);

        $response->setStatus('success');
        
        echo $response->respond();

        return true;
    }
}
