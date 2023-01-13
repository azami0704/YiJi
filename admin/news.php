<div style="width:100%;margin:auto;">
    <fieldset>
        <legend>最新文章管理</legend>
        <?php $table = 'News';$feature=strtolower($table);?>
        <form action="./api/<?=$feature?>.php" method="post">
            <table style="width: 100%;padding-inline:10px;">
                <tr>
                    <th style="width: 10%;">編號</th>
                    <th style="width: 70%;">標題</th>
                    <th style="width: 10%;">顯示</th>
                    <th style="width: 10%;">刪除</th>
                </tr>
                <?php
                $pageActive=$_GET['page']??1;
                $all=$$table->count(1);
                $div=3;
                $pages = ceil($all/$div);
                $pageStart=($pageActive-1)*$div;
                $rows = $$table->all(" LIMIT $pageStart, $div");
                foreach ($rows as $key=>$row) {
                    $checked=$row['sh']?'checked':'';
                ?>
                    <tr>
                        <th>
                            <?= $key+1?>.
                        </th>
                        <td>
                            <input type="hidden" name='id[]' value="<?=$row['id']?>">
                            <?= $row['title'] ?>
                        </td>
                        <td class="ct">
                            <input type="checkbox" name="sh[]" value="<?= $row['id'] ?>" <?=$checked?> >
                        </td>
                        <td class="ct">
                            <input type="checkbox" name="del[]" value="<?= $row['id'] ?>">
                        </td>
                    </tr>
                <?php
                }
                ?>
                <tr>
                    <td colspan="4" class="ct">
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
                <tr>
                    <td colspan="3" class="ct">
                        <input type="hidden" name="table" value="<?=$table?>">
                        <button class="button" type="submit">確定修改</button>
                    </td>
                </tr>
            </table>
           
            </fieldset>
        </form>