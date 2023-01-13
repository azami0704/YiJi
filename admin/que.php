<div style="width:45%;margin:auto;">
    <fieldset>
        <legend>新增問券</legend>
        <?php $table = 'Que';
        $feature = strtolower($table); ?>
        <form action="./api/<?= $feature ?>.php" method="post">
            <table style="width: 100%;padding-inline:10px;">
                <tbody>
                <tr>
                    <td style="width: 45%;">問券名稱</td>
                    <td style="width: 55%;">
                        <input type="text" name="title">
                    </td>
                </tr>
                <tr>
                    <td>
                        選項
                    </td>
                    <td>
                        <input type="text" name='opt[]'>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3" class="ct">
                        <input type="hidden" name="table" value="<?= $table ?>">
                        <button class="button" type="submit">新增</button>
                        <button class="button" type="reset">清空</button>
                        <button class="button" id="add-btn">更多</button>
                    </td>
                </tr>
                </tfoot>
            </table>
    </fieldset>
    </form>
    <script>
        $('#add-btn').click(function(e){
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