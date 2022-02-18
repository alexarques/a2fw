<?php

    namespace App\Controllers;

    
    use App\Registry;

class IndexController {

        public function index()
        {
            $users = Registry::get('database')->selectAll('usuarios');
            
            return view('index', compact('users'));
        }
    }