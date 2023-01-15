<div style="width:80%;margin:auto;">
    <fieldset>
        <legend>目前位置:首頁 > 最新文章區</legend>
        <?php $table = 'News';$feature=strtolower($table);?>
        <form>
            <table style="width: 100%;padding-inline:10px;">
                <tr>
                    <th style="width: 30%;">標題</th>
                    <th style="width: 60%;">內容</th>
                    <th style="width: 10%;"></th>
                </tr>
                <?php
                $pageActive=$_GET['page']??1;
                $all=$$table->count(['sh'=>1]);
                $div=5;
                $pages = ceil($all/$div);
                $pageStart=($pageActive-1)*$div;
                $rows = $$table->all(" WHERE `sh`='1' LIMIT $pageStart,$div");
                foreach ($rows as $key=>$row) {
                ?>
                    <tr data-num="<?=$row['id']?>">
                        <td style="width: 200px;background:#ccc;">
                        <?= $row['title']?>
                        </td>
                        <td class="text bigg" style="width:350px;display:inline-block;padding-left:8px;">
                        <?= $row['text'] ?>
                        </td>
                        <td style="vertical-align: top;">
                        <?php
                        if(isset($_SESSION['user'])){
                            $logs=$Log->all(['user_id'=>$_SESSION['user']['id'],'news_good'=>1]);
                            $chkArr=[];
                            foreach($logs as $log){
                                $chkArr[]=$log['news_id'];
                            }
                            $good = in_array($row['id'],$chkArr)?'收回讚':'讚';
                            ?>
                            <a href="#" class="good-btn"><?=$good?></a>
                            <?php
                        }else{
                            ?>
                            <img src="./icon/02B03.jpg" width='20px'>
                            <?php
                        }
                        ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
                <tr>
                    <td colspan="2" class="ct">
                    <?php
            if($pageActive-1>0){
                $pre=$pageActive-1;
                echo "<a href='?do=$feature&page=$pre'><</a>";
            }
            for($i=1;$i<=$pages;$i++){
                $size=($i==$pageActive)?"24px":"16px";
                echo "<a href='?do=$feature&page=$i' style='font-size:$size;'>$i</a>";
            }
            if($pageActive+1<=$pages){
                $next=$pageActive+1;
                echo "<a href='?do=$feature&page=$next'>></a>";
            }
            ?>
                    </td>
                </tr>
            </table>
           
            </fieldset>
        </form>

        <script>
            $(function(){
                $('.text').click(function(){
                    $(this).toggleClass('bigg');
                })

                $('.good-btn').click(function(e){
                    e.preventDefault();
                    let newsId=$(this).closest('tr').data('num')
                    $.post('./api/good.php',`user_id=<?=$_SESSION['user']['id']?>&news_id=${newsId}`)
                    .done(res=>{
                        $(this).text($(this).text()=="讚"?"收回讚":"讚");
                    })
                    .fail(err=>{
                        console.log(err);
                    })
                })
            })
            
        </script>