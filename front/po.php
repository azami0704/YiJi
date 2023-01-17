<div>
    目前位置: 首頁 > 分類網誌 > <span id="type">健康新知</span>
</div>

<fieldset style="display:inline-block;vertical-align:top;">
    <legend>分類網誌</legend>
    <?php
    $rows= q("SELECT `category` FROM `news` GROUP BY `category`");
    foreach ($rows as $key => $type) {
        echo "<a href='#' class='type' data-type='{$type['category']}' style='display:block;'>";
        echo $type['category'];
        echo "</a>";
    }
    ?>
</fieldset>
<fieldset style="display:inline-block;vertical-align:top;width:75%;">
    <legend>文章列表</legend>
    <div class="content">
    </div>
</fieldset>
<script>
    $(document).ready(function() {
        $('.type').click(function() {
            let text =$(this).text();
            $('#type').text(text);
            getList(text);
        })


        getList($('#type').text());
        function getList(type){
            $.get(`./api/po.php?type=${type}`)
            .done(res=>{
                $('.content').html(res);
                addEvent();
            })
            .fail(err=>{
                console.log(err);
            })

        }

        function addEvent(){
            $('.title').click(function(){
                let title = $(this).text();
                let text = $(this).next().text();
                $('.content').html(`<h3>${title}</h3><pre>${text}</pre>`);
            })
        }

    })
</script>