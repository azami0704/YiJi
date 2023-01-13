<?php
include_once "./base.php";

$table = $_POST['table'];
$page = strtolower($table);
if(isset($_POST['id'])){
    foreach($_POST['id'] as $id){
        if(isset($_POST['del']) && in_array($id,$_POST['del'])){
            $$table->del($id);
        }else{
            if(in_array($id,$_POST['sh'])){
                $$table->save(['sh'=>1],$id);
            }else{
                $$table->save(['sh'=>0],$id);
            }
        }
    }
}
to("../admin.php?do=$page");
?>