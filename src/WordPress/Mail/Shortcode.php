<?php

namespace Digia\WordPress\Mail;

class Shortcode
{
    public function contactForm($attributes)
    {
        $html = '<div class="contact-form-container">';
        $html .= '<div class="alert alert-success hide" id="contact-form-success">Success! Your message has been sent. We\'ll be in touch shortly.</div>';
        $html .= '<form action="' . admin_url('admin-ajax.php') . '" method="post" id="contact-form" novalidate>';
        $html .= '<div class="form-group">';
        $html .= '<label for="contact-fullname">Full Name</label>';
        $html .= '<input type="text" name="contact-fullName" class="form-control" required>';
        $html .= '<small class="alert alert-danger hide" id="contact-form-fullName-error"></small>';
        $html .= '</div>';
        $html .= '<div class="form-group">';
        $html .= '<label for="contact-phone">Phone Number</label>';
        $html .= '<input type="text" name="contact-phone" class="form-control">';
        $html .= '</div>';
        $html .= '<div class="form-group">';
        $html .= '<label for="contact-email">Email</label>';
        $html .= '<input type="text" name="contact-email" class="form-control" required>';
        $html .= '<small class="alert alert-danger hide" id="contact-form-email-error"></small>';
        $html .= '</div>';
        $html .= '<div class="form-group">';
        $html .= '<label for="contact-message">Message</label>';
        $html .= '<textarea name="contact-message" rows="10" class="form-control" required></textarea>';
        $html .= '<small class="alert alert-danger hide" id="contact-form-message-error"></small>';
        $html .= '</div>';
        $html .= '<div class="form-group">';
        $html .= '<button type="submit" class="btn btn-primary" id="contact-form-submit">Send</button>';
        $html .= '</div>';
        $html .= '<input type="hidden" name="action" value="sendContactEmail">';
        $html .= wp_nonce_field('sendContactEmail', 'contact-form-nonce');
        $html .= '</form>';
        $html .= '</div>';

        return $html;
    }
}
