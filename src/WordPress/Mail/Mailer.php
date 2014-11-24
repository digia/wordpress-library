<?php

namespace Digia\WordPress\Mail;

use Digia\Foundation\Mail\Mailer as BaseMailer;

abstract class Mailer extends BaseMailer
{
    /**
     * Get the WordPress admin email address found in Settings > General
     * 
     * @return string 
     */
    protected function getWpAdminEmail()
    {
        return get_option('admin_email'); 
    }

    /**
     * Get the WordPress site url (hostname)
     *
     * @return string
     */
    protected function getWpHostname()
    {
        return get_site_url();
    }

    /**
     * Get the site information from WordPress
     *
     * @return array
     */
    protected function getWpSiteInformation()
    {
        return get_bloginfo();
    }
}
