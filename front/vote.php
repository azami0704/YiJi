<div style="width:80%;margin:auto;">
    <fieldset>
        <?php $table = 'Que';
        $feature = strtolower($table); ?>
        <legend>目前位置: 首頁 > 問券調查 ><?=$$table->find(['id'=>$_GET['id']])['title']?></legend>
        <form action="./api/vote.php" method="post">
            <h3><?=$$table->find(['id'=>$_GET['id']])['title']?></h3>
            <?php
                $rows=$$table->all(['parent'=>$_GET['id']]);
                foreach($rows as $key =>$opt){
                    echo "<div><input type='radio' name='opt' value='{$opt['id']}'>{$opt['title']}</div>";
                }
            ?>
            <div class="ct">
                <input type="hidden" name='id' value="<?=$_GET['id']?>">
                <input type="submit" value="我要投票">
            </div>
    </fieldset>
    </form>
  