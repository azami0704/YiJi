<div style="width:45%;margin:auto;">
    <fieldset>
        <legend>帳號管理</legend>
        <form action="./api/del_user.php" method="post">
            <table style="width: 100%;padding-inline:10px;">
                <tr>
                    <td style="width: 45%;background:#ccc;">帳號</td>
                    <td style="width: 45%;background:#ccc;">密碼</td>
                    <td style="width: 10%;background:#ccc;">刪除</td>
                </tr>
                <?php
                $rows = $User->all();
                foreach ($rows as $row) {
                    if($row['acc']!='admin'){
                ?>
                    <tr>
                        <td>
                            <?= $row['acc'] ?>
                        </td>
                        <td>
                            <?= str_repeat('*', strlen($row['pw'])) ?>
                        </td>
                        <td>
                            <input type="checkbox" name="del[]" value="<?= $row['id'] ?>">
                        </td>
                    </tr>
                <?php
                }}
                ?>
                <tr>
                    <td colspan="3" class="ct">
                        <input type="hidden" name="table" value="User">
                        <button class="button" type="submit">確定刪除</button>
                        <button class="button" type="reset">清空選取</button>
                    </td>
                </tr>
            </table>
        </form>

        <form id="reg" action="./api/user.php" method="post">
            <h2>新增會員</h2>
            <table>
                <tr>
                    <td colspan="2" style="color:red;">*請設定您要註冊的帳號及密碼(最長12個字元)</td>
                </tr>
                <tr>
                    <td>
                        <label for="" style="background:#eee;width:200px;display:inline-block;padding:4px;">Step1:登入帳號</label>
                    </td>
                    <td>
                        <input type="text" name="acc" maxlength="12">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="" style="background:#eee;width:200px;display:inline-block;padding:4px;">Step2:登入密碼</label>
                    </td>
                    <td>
                        <input type="password" name="pw" maxlength="12">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="" style="background:#eee;width:200px;display:inline-block;padding:4px;">Step3:再次確認密碼</label>
                    </td>
                    <td>
                        <input type="password" id="confirm_password" maxlength="12">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="" style="background:#eee;width:200px;display:inline-block;padding:4px;">Step4:信箱(忘記密碼時使用)</label>
                    </td>
                    <td>
                        <input type="email" name="email">
                    </td>
                </tr>
            </table>
            <div style="float:left;">
                <button class="button" type="submit">新增</button>
                <button class="button" type="reset">清除</button>
            </div>
    </fieldset>
    </form>
</div>
<script>
    const form = $('#reg')
    form.submit(function(e) {
        e.preventDefault();
        if (!form[0][0].value || !form[0][1].value || !form[0][2].value || !form[0][3].value) {
            alert('不可空白');
        } else if (form[0][1].value !== form[0][2].value) {
            alert('密碼錯誤');
        } else {
            const data = form.serialize();
            $.post("./api/reg.php", data)
                .done(res => {
                    switch (res) {
                        case 'acc_exists':
                            alert('帳號重複');
                            break;
                        case 'reg_success':
                            alert('新增完成');
                            window.location.reload();
                            break;
                    }
                })
                .fail(err => {
                    alert(err);
                })
        }
    })
</script>