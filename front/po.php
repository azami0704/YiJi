<div>
    目前位置: 首頁 > 分類網誌 > <span id="type">健康新知</span>
</div>

<fieldset style="display:inline-block;vertical-align:top;">
    <legend>分類網誌</legend>
    <?php
    foreach ($News->type as $key => $type) {
        echo "<a href='#' class='type' data-type='$key' style='display:block;'>";
        echo $type;
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
            $('#type').text($(this).text());
        })

    })
</script>