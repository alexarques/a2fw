<?php
 
   namespace App\Controllers;
 
   use App\Controller;
   use App\Registry;
   use App\Request;
   use App\Session;
   use App\Database\Connection;
 
class RegisterController extends Controller {
 
    public function __construct(Request $request,Session $session){
    parent::__construct($request,$session);

}
    public function index(){
        return view('register');
    }
    
    public function form() {
            
    try {
        $username = filter_input(INPUT_POST, 'username');
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        $password2 = filter_input(INPUT_POST, 'password2');
        $rol = filter_input(INPUT_POST, 'rol');

        if(($username || $email || $password || $password2 || $rol) == null) {
            $this->redirectTo('register');
        }

        if($password == $password2) {
            $db = Registry::get('database');
            $sql = "INSERT INTO usuarios (username,email,passwd,rol) VALUES (?,?,?,?);";
            $stmt = $db->query($sql);
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $stmt->execute([$username,$email,$passwordHash,$rol]);
            $this->redirectTo('/login');
        } else {
            $this->redirectTo('register');
        }

    } catch (\PDOException $e) {
        die($e->getMessage());
    }
        //
    }
    // $stmt = $db->query($sql);
    // //$hashedPassword = password_hash($password, PASSWORD_DEFAULT, $opciones);
}