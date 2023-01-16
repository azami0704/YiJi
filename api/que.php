<?php
include_once "./base.php";

$table = $_POST['table'];
$page = strtolower($table);

if(isset($_POST['title'])&&$_POST['title']){
    $$table->save(['title'=>$_POST['title']]);
}
$parent = $$table->max('id',1);
foreach($_POST['opt'] as $opt){
    if($opt){
        $$table->save(['title'=>$opt,'parent'=>$parent]);
    }
}

to("../admin.php?do=$page");
?>