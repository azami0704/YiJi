<div style="width:80%;margin:auto;">
    <fieldset>
        <legend>目前位置:首頁 > 人氣文章區</legend>
        <?php $table = 'News';
        $feature = strtolower($table); ?>
        <form>
            <table style="width: 100%;padding-inline:10px;">
                <tr>
                    <th style="width: 30%;">標題</th>
                    <th style="width: 50%;">內容</th>
                    <th style="width: 20%;">人氣</th>
                </tr>
                <?php
                $pageActive = $_GET['page'] ?? 1;
                $all = $$table->count(['sh' => 1]);
                $div = 5;
                $pages = ceil($all / $div);
                $pageStart = ($pageActive - 1) * $div;
                $rows = $$table->all(" WHERE `sh`='1' LIMIT $pageStart,$div");
                foreach ($rows as $key => $row) {
                    $count = $row['good'];
                ?>
                    <tr data-num="<?= $row['id'] ?>">
                        <td style="width: 200px;background:#ccc;">
                            <?= $row['title'] ?>
                        </td>
                        <td class="text bigg" style="width:350px;display:inline-block;padding-left:8px;">
                            <?= $row['text'] ?>
                        </td>
                        <td style="vertical-align: top;">
                            <span><?= $count ?>個人說</span>
                            <?php
                            if ($_SESSION['user']) {
                                $logs = $Log->all(['user_id' => $_SESSION['user']['id'], 'news_good' => 1]);
                                $chkArr = [];
                                foreach ($logs as $log) {
                                    $chkArr[] = $log['news_id'];
                                }
                                $good = in_array($row['id'], $chkArr) ? '收回讚' : "<img src='./icon/02B03.jpg' width='20px'>";
                            ?>
                                <a href="#" class="good-btn"><?= $good ?></a>
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
                        if ($pageActive - 1 > 0) {
                            $pre = $pageActive - 1;
                            echo "<a href='?do={$_GET['do']}&page=$pre'><</a>";
                        }
                        for ($i = 1; $i <= $pages; $i++) {
                            $size = ($i == $pageActive) ? "24px" : "16px";
                            echo "<a href='?do={$_GET['do']}&page=$i' style='font-size:$size;'>$i</a>";
                        }
                        if ($pageActive + 1 <= $pages) {
                            $next = $pageActive + 1;
                            echo "<a href='?do={$_GET['do']}&page=$next'>></a>";
                        }
                        ?>
                    </td>
                </tr>
            </table>

    </fieldset>
    </form>

    <script>
        $(function() {
            $('.text').click(function() {
                $(this).toggleClass('bigg');
            })

            $('.good-btn').click(function(e) {
                e.preventDefault();
                let newsId = $(this).closest('tr').data('num')
                $.post('./api/good.php', `user_id=<?= $_SESSION['user']['id'] ?>&news_id=${newsId}`)
                    .done(res => {
                        $(this).prev().text(`${res.split(' ')[0]}個人說`)
                        $(this).html(res.split(' ')[1]=='+' ? "<span>收回讚</span>" : `<img src='./icon/02B03.jpg' width='20px'>`);
                    })
                    .fail(err => {
                        console.log(err);
                    })
            })
        })
    </script>