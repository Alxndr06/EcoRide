<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Employee.php';
require_once __DIR__ . "/../helpers/functions.php";
class AdminController extends Controller
{
    public function dashboard() : void
    {
        checkConnect();
        checkRole(3);
        self::render('admin/dashboard');
    }

    public function employees() : void
    {
        checkRole(3);
        $employees = Employee::getAll();
        self::render('admin/employees', ['employees' => $employees]);
    }
}
