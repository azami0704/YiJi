<?php
include_once "./base.php";

$goodLog=$Log->find(['user_id'=>$_POST['user_id'],'news_id'=>$_POST['news_id']]);
if($goodLog){
    $id=$goodLog['id'];
    unset($goodLog['id']);
    if($goodLog['news_good']){
        $goodLog['news_good']=0;
        $Log->save($goodLog,$id);
        
        updateNews('--');
        $status='-';
    }else{
        $goodLog['news_good']=1;
        $Log->save($goodLog,$id);
        
        updateNews('++');
        $status='+';
    }
}else{
    $Log->save(['user_id'=>$_POST['user_id'],'news_id'=>$_POST['news_id'],'news_good'=>1]);
    
    updateNews('++');
    $status='+';
}
echo $News->find(['id'=>$_POST['news_id']])['good']." $status";




function updateNews($math){
    global $News;
    $newsCount=$News->find(['id'=>$_POST['news_id']]);
    $id=$newsCount['id'];
    unset($newsCount['id']);
    if($math=='++'){
        $newsCount['good']++;
    }else{
        $newsCount['good']--;
    }
    $News->save($newsCount,$id);
}

?>