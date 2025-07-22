<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . "/../helpers/functions.php";
class EmployeeController extends Controller
{
    public static function dashboard() : void
    {
        checkConnect();
        checkRole(2);
        self::render('employee/dashboard');
    }

}