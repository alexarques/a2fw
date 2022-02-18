<?php

    namespace App\Controllers;

    class PagesController{

        function index(){
            return view('index');
        }

        function home(){
            return view('home');
        }

        function about(){
            return view('about');
        }

        function login(){
            return view('login');
        }

        function register(){
            return view('register');
        }

        function todo_list(){
            return view('todo_list');
        }
    }