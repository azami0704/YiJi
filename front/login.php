<form id="login" style="width:45%;margin:auto;">
    <fieldset>
        <legend>會員登入</legend>
        <table>
            <tr>
                <td>
                    <label for="" style="background:#ccc;width:100px;display:inline-block;padding:4px;">帳號</label>
                </td>
                <td>
                    <input type="text" name="acc">
                </td>
            </tr>
            <te>
                <td>
                    <label for="" style="background:#ccc;width:100px;display:inline-block;padding:4px;">密碼</label>
                </td>
                <td>
                    <input type="password" name="pw">
                </td>
            </te>
        </table>
        <div style="float:left;">
            <button class="button" type="submit">登入</button>
            <button class="button" type="reset">清除</button>
        </div>
        <div class="" style="float:right;">
            <a href="?do=forgot">忘記密碼</a>|
            <a href="?do=reg">尚未註冊</a>
        </div>
    </fieldset>
</form>

<script>
    const form = $('#login')
    form.submit(function(e) {
        e.preventDefault();
        if (!form[0][1].value || !form[0][2].value) {
            alert('請輸入完整資料');
        } else {
            const data = form.serialize();
            $.post("./api/login.php", data)
                .done(res => {
                    switch (res) {
                        case 'acc_not_found':
                            alert('查無帳號');
                            form.trigger('reset');
                            break;
                        case 'pw_error':
                            alert('密碼錯誤');
                            form.trigger('reset');
                            break;
                        case 'admin_login_success':
                            window.location.href = "./admin.php";
                            break;
                        case 'login_success':
                            window.location.href = "./index.php";
                            break;
                    }
                })
                .fail(err => {
                    alert(err);
                })
        }
    })
</script>