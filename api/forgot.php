<?php
include_once "./base.php";


 if(isset($_POST['email'])){
        $pw =$User->find(['email'=>$_POST['email']]);
        if(empty($pw)){
            echo "查無此資料";
        }else{
            echo "您的密碼為:".$pw['pw'];
        }
    }