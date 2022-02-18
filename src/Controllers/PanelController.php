<?php
 
   namespace App\Controllers;
 
   use App\Controller;
   use App\Registry;
   use App\Request;
   use App\Session;
   use App\Database\Connection;
 
 
class PanelController extends Controller {
 
    public function __construct(Request $request,Session $session){

       parent::__construct($request,$session);

       try {


    } catch (\PDOException $e) {
        die($e->getMessage());
    }
    }
    public function index(){
        return view('panel');
    }
    public function curs(){
        try {
            $db = Registry::get('database');
            $sql_usrid = "SELECT id from usuarios;"; //id de usr
            $stmt_usrid = $db->query($sql_usrid);
            $stmt_usrid->execute();
            foreach($stmt_usrid as $id){
                $idusr = $id["id"];
            }
            $_SESSION["usrList"] = $idusr;
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }
}