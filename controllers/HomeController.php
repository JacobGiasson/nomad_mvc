<?php
namespace App\Controllers;

use App\Providers\View;

class HomeController {

    // Home page
    public function index(){
        return View::render('home');
    }
}