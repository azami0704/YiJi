<?php
include_once "./base.php";

$opt=$Que->find($_POST['opt']);
$subject = $Que->find(['id'=>$opt['parent']]);

$Que->save(['count'=>$opt['count']+=1],$_POST['opt']);
$Que->save(['count'=>$subject['count']+=1],$subject['id']);


to("../index.php?do=result&id={$_POST['id']}");
?>