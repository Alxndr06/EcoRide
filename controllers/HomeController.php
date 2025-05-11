<?php

require_once 'core/Controller.php';

class HomeController extends Controller
{
    public function index()
    {
        self::render('home/index');
    }
}