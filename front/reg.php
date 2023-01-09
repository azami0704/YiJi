<form id="reg" style="width:45%;margin:auto;">
    <fieldset>
        <legend>會員註冊</legend>
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
            <button class="button" type="submit">註冊</button>
            <button class="button" type="reset">清除</button>
        </div>
    </fieldset>
</form>

<script>
    const form = $('#reg')
    form.submit(function(e) {
        e.preventDefault();
        if (!form[0][1].value || !form[0][2].value|| !form[0][3].value|| !form[0][4].value) {
            alert('不可空白');
        } else if(form[0][2].value!==form[0][3].value){
            alert('密碼錯誤');
        }else {
            const data = form.serialize();
            $.post("./api/reg.php", data)
                .done(res => {
                    switch (res) {
                        case 'acc_exists':
                            alert('帳號重複');
                        break;
                        case 'reg_success':
                            alert('註冊成功，歡迎加入');
                            window.location.href = "?do=login";
                        break;
                    }
                })
                .fail(err => {
                    alert(err);
                })
        }
    })
</script>