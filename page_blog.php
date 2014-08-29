<?php

 /************************************************
 * Template Name: Blog
 * This file handles blog post listings within a page.
 * @package Genesis
 * @authors  Nate Lewis & Jason Lewis
 * @link    http://practicalit.info/
 ************************************************/
add_action('genesis_loop', 'genesis_standard_loop', 8);

genesis();
