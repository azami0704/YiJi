<?php
include_once "./base.php";


$goodLog=$Log->find(['user_id'=>$_POST['user_id'],'news_id'=>$_POST['news_id']]);
if($goodLog){
    if($goodLog['news_good']){
        $Log->save(['news_good'=>0],$goodLog['id']);
        
        updateNews('--');
    }else{
        $Log->save(['news_good'=>1],$goodLog['id']);
        
        updateNews('++');
    }
}else{
    $Log->save(['user_id'=>$_POST['user_id'],'news_id'=>$_POST['news_id'],'news_good'=>1]);
    
    updateNews('++');
}
echo $News->find(['id'=>$_POST['news_id']])['good'];




function updateNews($math){
    global $News;
    $newsCount=$News->find(['id'=>$_POST['news_id']]);
    if($math=='++'){
        $newsCount['good']++;
    }else{
        $newsCount['good']--;
    }
    $News->save(['good'=>$newsCount['good']],$newsCount['id']);
}

?>