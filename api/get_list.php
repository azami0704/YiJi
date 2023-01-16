<?php
include_once "./base.php";

$type=$_GET['type'];

$lists= $News->all(['type'=>$type,'sh'=>1]);

foreach($list as $list){
    
}
?>