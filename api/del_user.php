<?php
include_once "./base.php";

$table = $_POST['table'];
$page = strtolower($table);
if(isset($_POST['del'])){
    foreach($_POST['del'] as $id){
        $$table->del($id);
    }
}
to("../admin.php?do=$page");



?>