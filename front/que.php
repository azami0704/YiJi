<div style="width:100%;margin:auto;">
    <fieldset>
        <legend>目前位置: 首頁 > 問券調查</legend>
        <?php $table = 'Que';
        $feature = strtolower($table); ?>
        <form action="./api/<?= $feature ?>.php" method="post">
            <table style="width: 100%;padding-inline:10px;">
                <tbody>
                    <tr>
                        <td style="width: 10%;">編號</td>
                        <td style="width: 60%;">問券題目</td>
                        <td style="width: 10%;">投票總數</td>
                        <td style="width: 5%;">結果</td>
                        <td style="width: 15%;">狀態</td>
                    </tr>
                    <?php
                    $rows = $$table->all(['parent' => 0]);
                    foreach ($rows as $key => $que) {
                    ?>
                        <tr>
                            <td style="width: 10%;"><?=$key+1?></td>
                            <td style="width: 60%;"><?=$que['title']?></td>
                            <td style="width: 10%;"><?=$que['count']?></td>
                            <td style="width: 5%;"><a href="?do=result&id=<?=$que['id']?>">結果</a></td>
                            <td style="width: 15%;">
                            <?php
                            if(isset($_SESSION['user'])){
                                echo "<a href='?do=vote&id={$que['id']}'>投票</a>";
                            }else{
                                echo "<a href='?do=login'>請先登入</a>";
                            }
                            ?>
                        </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
                <tfoot>
                    <!-- <tr>
                    <td colspan="3" class="ct">
                        <input type="hidden" name="table" value="<?= $table ?>">
                        <button class="button" type="submit">新增</button>
                        <button class="button" type="reset">清空</button>
                        <button class="button" id="add-btn">更多</button>
                    </td>
                </tr> -->
                </tfoot>
            </table>
    </fieldset>
    </form>
    <script>
        $('#add-btn').click(function(e) {
            e.preventDefault();
            $('tbody').append(` <tr>
                    <td>
                        選項
                    </td>
                    <td>
                        <input type="text" name='opt[]'>
                    </td>
                </tr>`);
        })
    </script>