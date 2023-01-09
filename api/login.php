<?php
include_once "./base.php";

if(!empty($_POST['acc'])){
    $user=$User->find(['acc'=>$_POST['acc']]);
    if(!empty($user)){
        if($user['pw']==$_POST['pw']){
            $admin='';
            if($user['acc']=='admin'){
                $admin='admin_';
            }
            echo $admin."login_success";
            $_SESSION['user']=$user;
        }else{
            echo "pw_error";
        }
    }else{
        echo "acc_not_found";
    }
}else{
    echo "login_error";
}



?>