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
        try {
            $db = Registry::get('database');
            $sql_usr = "SELECT * from usuarios;";
            $stmt_usr = $db->query($sql_usr);
            $stmt_usr->execute();
            $allUsers = $stmt_usr->fetchAll();
            $_SESSION["usrList"] = $allUsers;

            //CURSOS
            $sql_shCurs = "SELECT * from cursos;";
            $stmt_shCurs= $db->query($sql_shCurs);
            $stmt_shCurs->execute();
            $shCurs = $stmt_shCurs->fetchAll();
            $_SESSION["shCurs"] = $shCurs;

            //PROFESSORS
            $sql_shProf = "SELECT * from usuarios WHERE rol=2;";
            $stmt_shProf= $db->query($sql_shProf);
            $stmt_shProf->execute();
            $shProf = $stmt_shProf->fetchAll();
            $_SESSION["shProf"] = $shProf;

            // //CURSOS
            // $sql_shCurs = "SELECT curs_name from cursos;";
            // $stmt_shCurs= $db->query($sql_shCurs);
            // $stmt_shCurs->execute();
            // $shCurs = $stmt_shCurs->fetchAll();
            // $_SESSION["shCurs"] = $shCurs;

            //ID CURS
            $sql_shCursID = "SELECT id from cursos;";
            $stmt_shCursID= $db->query($sql_shCursID);
            $stmt_shCursID->execute();
            $shCursID = $stmt_shCursID->fetchAll();

            //MATERIAS
            foreach($shCursID as $id){
                $sql_shMateria = "SELECT materia_name from materias WHERE id_curs = '".$id[0]."';";
                $stmt_shMateria= $db->query($sql_shMateria);
                $stmt_shMateria->execute();
                $shMateria = $stmt_shMateria->fetchAll();
                $_SESSION["shMateria".$id[0]] = $shMateria;
            }
        } catch (\PDOException $e) {
            die($e->getMessage());
        }

        return view('panel');
    }

    public function curs(){

        $createCursBtn = filter_input(INPUT_POST, "createCurs");
        $nameCurs = filter_input(INPUT_POST, "nameCurs");

        $createMatBtn = filter_input(INPUT_POST, "createMat");
        $createMatCurs = filter_input(INPUT_POST, "crearMatCurs");
        $createMatProf = filter_input(INPUT_POST, "crearMatProf");
        $nameMat = filter_input(INPUT_POST, "nameMat");

        $deleteCurs = filter_input(INPUT_POST, "deleteCurs");
        $deleteCursName = filter_input(INPUT_POST, "deleteCursName");

        var_dump($nameMat);

        if($createCursBtn){
            $db = Registry::get('database');
            $sql_cursCreate = "INSERT INTO cursos (curs_name) VALUES ('".$nameCurs."');";
            $stmt_cursCreate = $db->query($sql_cursCreate);
            $stmt_cursCreate->execute();
        }

        if($createMatBtn){
            $db = Registry::get('database');
            $sql_idProf = "SELECT id from professors WHERE id_user = '".$createMatProf."';";
            $stmt_idProf= $db->query($sql_idProf);
            $stmt_idProf->execute();
            $idProf = $stmt_idProf->fetchAll();
            var_dump($idProf);
            $sql_matCreate = "INSERT INTO materias (materia_name,id_curs,id_profesor) VALUES ('".$nameMat."','".intval($createMatCurs)."','".intval($idProf[0])."');";
            $stmt_matCreate = $db->query($sql_matCreate);
            $stmt_matCreate->execute();
            var_dump($sql_matCreate);
        }

        if($deleteCurs){
            $db = Registry::get('database');
            $sql_delCurs = "DELETE from cursos WHERE curs_name = '".$deleteCursName."';";
            $stmt_delCurs = $db->query($sql_delCurs);
            $stmt_delCurs->execute();
        }

        $this->redirectTo('/panel');
    }

    public function edit(){

        $roleSelectUsr = filter_input(INPUT_POST, "roleSelectUsr");
        $roleSelect = filter_input(INPUT_POST, "roleSelect");
        $roleSelectBtn = filter_input(INPUT_POST, "roleSelectBtn");

        $cursoSelectUsr = filter_input(INPUT_POST, "cursoSelectUsr");
        $cursoSelect = filter_input(INPUT_POST, "cursoSelect");
        $cursoSelectBtn = filter_input(INPUT_POST, "cursoSelectBtn");

        $delUserBtn = filter_input(INPUT_POST, "delUser");

        if($cursoSelectBtn){
            $db = Registry::get('database');

            $sql_idCurs = "SELECT id from cursos WHERE curs_name = '".$cursoSelect."';";
            $stmt_idCurs= $db->query($sql_idCurs);
            $stmt_idCurs->execute();
            $idCurs = $stmt_idCurs->fetchAll();

            // $sql_shMateria = "SELECT id from cursos WHERE username = '".$selectUsr."';";
            // $stmt_shMateria= $db->query($sql_shMateria);
            // $stmt_shMateria->execute();
            // $shMateria = $stmt_shMateria->fetchAll();

            $sql_curs = "INSERT INTO usuarios_cursos (id_curso,id_usuarios) VALUES ('".intval($idCurs[0]["id"])."','".intval($cursoSelectUsr)."');";
            $stmt_curs = $db->query($sql_curs);
            $stmt_curs->execute();

            var_dump($sql_curs);
        }   
        
        if($roleSelectBtn){
            // var_dump($cursoSelectUsr);
            $hiquetal = "hola";
            if($roleSelect == 2){
                $db = Registry::get('database');
                $sql_actRol2 = "INSERT INTO professors (id_user) VALUES ('".intval($cursoSelectUsr)."');";
                $stmt_actRol2 = $db->query($sql_actRol2);
                $stmt_actRol2->execute();
                // var_dump($sql_actRol2);
            } else {
                $db = Registry::get('database');
                $sql_actRol = "DELETE FROM professors WHERE id_user = '".$cursoSelectUsr."';";
                $stmt_actRol = $db->query($sql_actRol);
                $stmt_actRol->execute();
                // var_dump($sql_actRol);
            }
            $db = Registry::get('database');
            $sql_roleSel = "UPDATE usuarios SET rol = '".$roleSelect."' WHERE username = '".$roleSelectUsr."';";
            $stmt_roleSel = $db->query($sql_roleSel);
            $stmt_roleSel->execute();
            // var_dump($sql_roleSel);
        }
        // "DELETE FROM `users` WHERE `id` = ?"
        if($delUserBtn){
            $db = Registry::get('database');
            $sql_delUser = "DELETE FROM usuarios WHERE id = '".$cursoSelectUsr."';";
            $stmt_delUser = $db->query($sql_delUser);
            $stmt_delUser->execute();
        }
        
        $this->redirectTo('/panel');
    }
    
}