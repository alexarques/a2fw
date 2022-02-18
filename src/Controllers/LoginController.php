<?php
 
   namespace App\Controllers;
 
   use App\Controller;
   use App\Registry;
   use App\Request;
   use App\Session;
   use App\Database\Connection;
 
 
class LoginController extends Controller {
 
    public function __construct(Request $request,Session $session){

       parent::__construct($request,$session);
 
    }
    public function index(){
        return view('login');
    }

    public function form(){
        try {
            $username = filter_input(INPUT_POST, "username");
            $password = filter_input(INPUT_POST, "password");
            // $db = getConnection($dsn,$dbuser,$dbpasswd);
            // $stmt = $db->prepare("SELECT * from users WHERE username = '".$username."';");
            // $stmt->execute();
            // $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // $dbpass = $results[0];
            $db = Registry::get('database');
            $sql = "SELECT * from usuarios WHERE username = '".$username."';";
            $stmt = $db->query($sql);
            $stmt->execute();
            $results = $stmt->fetchAll();
            $verify = password_verify($password,$results[0]["passwd"]);
            $_SESSION["userRol"] = $results[0]["rol"];
            var_dump($results[0]["rol"]);
            var_dump($password);
            var_dump($verify);
            //$remember = filter_input(INPUT_POST, "remember");
            $login = filter_input(INPUT_POST, "login");
            
            if(empty($results) == false && $verify){
        
                //Te has logueado correctamente
                session_start();
                $_SESSION["username"] = $username; 
                //$_SESSION["date"] = "";
                var_dump("login");
                $this->redirectTo('/main');
            } else {
                //No te has podido loguear
                $_SESSION["error"]="*Usuario o contraseña erronéos";
                //header("Location:?url=login");
            }
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }
}