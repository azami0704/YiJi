<?php
include_once "./base.php";

$lists=$News->all(['category'=>$_GET['type']]);

$html = "";
foreach($lists as $po){
    // print_r($po);
    $html.="<a href='#' class='title' style='display:block;'>".$po['title']."</a>";
    $html.="<div class='text' style='display:none;'>".$po['text']."</div>";
}

echo $html;
?>