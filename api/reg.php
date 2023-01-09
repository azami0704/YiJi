<?php
include_once "./base.php";

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

?>