<?php
include_once "./base.php";
?>

<div style="width:80%;margin:auto;">
    <fieldset>
        <legend>目前位置:首頁 > 人氣文章區</legend>
        <?php $table = 'News';
        $feature = strtolower($table); ?>
        <form>
            <table style="width: 100%;padding-inline:10px;">
                <tr>
                    <th style="width: 30%;">標題</th>
                    <th style="width: 40%;">內容</th>
                    <th style="width: 30%;">人氣</th>
                </tr>
                <?php
                $pageActive = $_GET['page'] ?? 1;
                $all = $$table->count(['sh' => 1]);
                $div = 5;
                $pages = ceil($all / $div);
                $pageStart = ($pageActive - 1) * $div;
                $rows = $$table->all(" WHERE `sh`='1' ORDER BY `good` DESC LIMIT $pageStart,$div");
                foreach ($rows as $key => $row) {
                    $count = $row['good'];
                ?>
                    <tr data-num="<?= $row['id'] ?>" class="text">
                        <td style="width: 200px;background:#ccc;">
                            <?= $row['title'] ?>
                        </td>
                        <td class="bigg " style="width:350px;display:inline-block;padding-left:8px;">
                            <?= $row['text'] ?>
                        </td>
                        <td style="vertical-align: top;" class="td-good">
                            <span><?= $count ?>個人說</span>
                            <?php
                            if (isset($_SESSION['user'])) {
                                $logs = $Log->all(['user_id' => $_SESSION['user']['id'], 'news_good' => 1]);
                                $chkArr = [];
                                foreach ($logs as $log) {
                                    $chkArr[] = $log['news_id'];
                                }
                                $good = in_array($row['id'], $chkArr) ? '收回讚' : "讚";
                            ?>
                                <a href="#" class="good-btn"><img src='./icon/02B03.jpg' width='20px'> <span><?= $good ?></span></a>
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
                        if ($pageActive - 1 > 0) {
                            $pre = $pageActive - 1;
                            echo "<a href='#' class='page-btn' data-page='$pre'><</a>";
                        }
                        for ($i = 1; $i <= $pages; $i++) {
                            $active = ($i == $pageActive) ? "page-active" : "";
                            echo "<a href='#' data-page='$i'  class='page-btn $active'>$i</a>";
                        }
                        if ($pageActive + 1 <= $pages) {
                            $next = $pageActive + 1;
                            echo "<a href='#' data-page='$next' class='page-btn'> ></a>";
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>

    <script>
        $(document).ready(function() {
            $('.text').hover(function(e) {
                if(!$(e.target).hasClass('td-good')){
                    let title = $(this).children('td').eq(0).text();
                    let content = $(this).children('td').eq(1).text();
                    $('#alerr').html(`<h3>${title}</h3><pre>${content}</pre>`);
                    $('#alerr').css({'top':$(this).offset().top+30,'left':$(this).offset().left+200})
                    $('#alerr').show();
                }
            },function(){
                $('#alerr').hide();
            })

            $('.page-btn').click(function(){
               getPage('pop',$(this).data('page'));
            })

            $('.good-btn').click(function(e) {
                e.preventDefault();
                let newsId = $(this).closest('tr').data('num');
                $.post('./api/good.php', `user_id=<?= $_SESSION['user']['id'] ?>&news_id=${newsId}`)
                    .done(res => {
                        $(this).prev().text(`${res}個人說`);
                        let good=$(this).children('span').text()=="讚"? "收回讚" : `讚`;
                        $(this).children('span').text(good);
                        getPage('pop',$('.page-active').text());
                    })
                    .fail(err => {
                        console.log(err);
                    })
            })
        })
    </script>