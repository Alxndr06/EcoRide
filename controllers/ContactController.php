<?php

require_once 'core/Controller.php';

class ContactController extends Controller
{
    public static function contact()
    {
        self::render('contact/contact');
    }
}

