<div style="width:80%;margin:auto;">
    <fieldset>
        <?php $table = 'Que';
        $feature = strtolower($table); ?>
        <legend>目前位置: 首頁 > 問券調查 ><?=$$table->find(['id'=>$_GET['id']])['title']?></legend>
            <h3><?=$$table->find(['id'=>$_GET['id']])['title']?></h3>
            <?php
                $rows=$$table->all(['parent'=>$_GET['id']]);
                
                foreach($rows as $key =>$opt){
                    $vote=$opt['count'];
                    $all=$$table->find(['id'=>$_GET['id']])['count']==0?1:$$table->find(['id'=>$_GET['id']])['count'];
                    $rate = round((($vote/$all)*100),1);
                    $rateWidth = ($vote/$all)*100*0.7;
                    echo "<div style='display:flex;'>";
                    echo "<div style='width:50%;'>";
                    echo $key+1 . ".";
                    echo $opt['title'];
                    echo "</div>";
                    echo "<div style='width:50%;'>";
                    echo "<div class='bar' style='width:$rateWidth%'></div>";
                    echo "{$opt['count']}票($rate%)";
                    echo "</div>";
                    echo "</div>";
                }
            ?>
            <div class="ct">
                <a href="?do=que" value="返回" class="button">返回</a>
            </div>
    </fieldset>