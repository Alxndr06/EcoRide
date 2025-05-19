<?php

require_once 'core/Controller.php';

class AboutController extends Controller
{
    public static function about()
    {
        self::render('about/about');
    }
}