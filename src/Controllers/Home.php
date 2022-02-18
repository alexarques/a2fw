<?php

    namespace App\Controllers\Home;

    class HomeController {
        public function __construct(Request $request,Session $session){

            parent::__construct($request,$session);
      
        }
            public function index(){
                return view('home');
            }
    }

