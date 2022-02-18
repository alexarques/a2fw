<?php
 
   namespace App\Controllers;
 
   use App\Controller;
   use App\Registry;
   use App\Request;
   use App\Session;
   use App\Database\Connection;
 
 
class MainController extends Controller {
 
    public function __construct(Request $request,Session $session){

       parent::__construct($request,$session);
 
    }
    public function index(){
        return view('main');
    }

    // public function idUser(){
    //     $username = $_SESSION["username"];
    //     $password = filter_input(INPUT_POST, "password");
 
    //     //ID DE USUARIO
    //     $db = Registry::get('database');
    //     $sql_id = "SELECT id from usuarios WHERE username = '".$username."';"; //id de usr
    //     $stmt_id = $db->query($sql_id);
    //     $stmt_id->execute();
    //     $idArray = $stmt_id->fetchAll();
 
    //     foreach($idArray as $id){
    //         $idusr = $id["id"];
    //     }
    //     $_SESSION["usrid"] = $idusr;
    // }

    public function formList(){
        try {
            $username = $_SESSION["username"];
            $password = filter_input(INPUT_POST, "password");
     
            //ID DE USUARIO
            $db = Registry::get('database');
            $sql_id = "SELECT id from usuarios WHERE username = '".$username."';"; //id de usr
            $stmt_id = $db->query($sql_id);
            $stmt_id->execute();
            $idArray = $stmt_id->fetchAll();
     
            foreach($idArray as $id){
                $idusr = $id["id"];
            }
            $_SESSION["usrid"] = $idusr;

            //CARGAR Y EJECUTAR LA SENTENCIA DE LA TABLA LIST
            $sql_list = "SELECT * from listas WHERE id_user = '".intval($idusr)."';"; //listas creadas por usr
            $stmt_list = $db->query($sql_list);
            $stmt_list->execute();
            $list = $stmt_list->fetchAll();
            $dblist = $list[0];
            var_dump($list);
            $_SESSION["list"] = $list;

            //CREAR LISTA
            $sql_newList = "INSERT INTO listas (list_name,id_user) VALUES (?,?);";
            $stmt_newList = $db->query($sql_newList);
            $createList = filter_input(INPUT_POST, "createlist");
            $_SESSION["submitList"] = $createList;
            $namelist = filter_input(INPUT_POST, "list");
            if ($namelist != null && $createList != null){
                //Se han introducido los datos en la bd
                $stmt_newList->execute([$namelist,$idusr]);
                $results = $stmt_newList->fetchAll();
                $_SESSION["created"] = "Se ha creado correctamente";
                $this->redirectTo('/main');
            } 
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }
    
    public function showMaterias(){
        try {
            $sql_list = "SELECT * from listas WHERE id_user = '".intval($idusr)."';"; //listas creadas por usr
            $stmt_list = $db->query($sql_list);
            $stmt_list->execute();
            $list = $stmt_list->fetchAll();
            $dblist = $list[0];
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    public function formTask(){
        try {
            $username = $_SESSION["username"];
            $password = filter_input(INPUT_POST, "password");
     
            //ID DE USUARIO
            $db = Registry::get('database');
            $sql_id = "SELECT id from usuarios WHERE username = '".$username."';"; //id de usr
            $stmt_id = $db->query($sql_id);
            $stmt_id->execute();
            $idArray = $stmt_id->fetchAll();
    
            foreach($idArray as $id){
                $idusr = $id["id"];
            }
            $_SESSION["usrid"] = $idusr;

            //CARGAR Y EJECUTAR LA SENTENCIA DE LA TABLA LIST
            $sql_list = "SELECT * from listas WHERE id_user = '".intval($idusr)."';"; //listas creadas por usr
            $stmt_list = $db->query($sql_list);
            $stmt_list->execute();
            $list = $stmt_list->fetchAll();
            $dblist = $list[0];
            var_dump($list);
            $_SESSION["list"] = $list;

            //INSERT EN TABLA TASK MEDIANTE INPUT
            $db = Registry::get('database');
            $selectedList = filter_input(INPUT_POST, "lists");
            $sql_newTask = "INSERT INTO tareas (tarea_name,description,id_list,id_user) VALUES (?,?,?,?);";
            $nametask = filter_input(INPUT_POST, "task");
            $taskDes = filter_input(INPUT_POST, "taskdes");
            $createTask = filter_input(INPUT_POST, "createtask");
            //$_SESSION["submitList"] = $createList;
            if (filter_input(INPUT_POST, "refresh") != null){
                $this->redirectTo('/main');
            }
            if ($nametask != null && $createTask != null){
                //Se han introducido los datos en la bd
                $stmt_newTask = $db->query($sql_newTask);
                $stmt_newTask->execute([$nametask,$taskDes,$selectedList,$idusr]);
                $_SESSION["created"] = "Se ha creado correctamente";
                $this->redirectTo('/main');
            }
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    public function form(){
        try {
            //MOSTRAR TASKS EN LISTAS
            $showLists = filter_input(INPUT_POST, "showLists");
            $showTasks = filter_input(INPUT_POST, "showTasks");
            if ($showTasks != null) {
                $db = Registry::get('database');
                $idusr = $_SESSION["usrid"];
                $sql_shTask = "SELECT tarea_name, description from tareas WHERE id_list = '".$showLists."' and id_user = '".intval($idusr)."';";
                $stmt_shTask= $db->query($sql_shTask);
                $stmt_shTask->execute();
                $tasks = $stmt_shTask->fetchAll();
                $arrTask = $tasks[0];
                // var_dump($stmt_shTask);
                $_SESSION["allTasks"] = $tasks;
                // var_dump($_SESSION["allTasks"]);
                // $dbtask = $task[0];
                $this->redirectTo('/main');
                // var_dump($showLists);
                // var_dump($idusr);
                // foreach($_SESSION["allTasks"] as $allTasks){
                //     echo $allTasks;
                // }
            }

            // $stmt_list = $db->prepare("SELECT list from list WHERE id = '".intval($id)."';");
            // $stmt_taskPrint = $db->prepare("SELECT task,list_task,descript from task WHERE username_id = '".intval($id)."';");
            // $stmt_taskPrint->execute();
            // $taskPrint = $stmt_taskPrint->fetchAll(PDO::FETCH_ASSOC);
            // $showTask = $taskPrint[0];
            //if ($dbtask != null){
                // $_SESSION["task"] = $dblist["task"];
                // $_SESSION["list"] = $list;
                // $_SESSION["descript"] = $dblist["descript"];
                // foreach($showTask as $task){
                //     //var_dump($task);
                // }
            //}
            } catch (\PDOException $e) {
                die($e->getMessage());
            }
        } 

        public function delList(){
            try {
                $nametask = filter_input(INPUT_POST, "task");
                $selectedListsDel = filter_input(INPUT_POST, "listsDel");
                var_dump($selectedListsDel);
                $db = Registry::get('database');
                $sql_selList = "DELETE * from listas WHERE id_name = '".$selectedListsDel."';"; //listas creadas por usr
                $stmt_selList = $db->query($sql_selList);
                $stmt_selList->execute();
                $list = $stmt_selList->fetchAll();
                $dblist = $list[0];
            } catch (\PDOException $e) {
                die($e->getMessage());
            }
        } 
        
        public function delTask(){
            try {
                
            } catch (\PDOException $e) {
                die($e->getMessage());
            }
        } 

    }