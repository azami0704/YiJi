<?php
include_once "./base.php";

if(isset($_POST['del'])){
    foreach($_POST['del'] as $id){
        $User->del($id);
    }
    to("../admin.php?do=user");
}

if(isset($_POST['acc'])){
    $User->find(['acc'=>$_POST['acc']]);
    if(empty($User->find(['acc'=>$_POST['acc']]))){
        $res=$User->save($_POST);
        if($res){
            echo "reg_success";
        }else{
            echo "reg_fail";
        }
    }else{
        echo "acc_exists";
    }
}


?>