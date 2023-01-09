<form id="forgot" style="width:45%;margin:auto;border:1px solid #ccc;height:150px;">
    <div for="">請輸入信箱以查詢密碼</div>
    <input type="email" id="email" name="email">
    <div id="password"></div>
    <button type="submit">尋找</button>
</form>

<script>
    const forgot = $('#forgot');
    const email = $('#email');
    const password=$('#password');

    forgot.submit(function(e){
        e.preventDefault();
        if(email.val()){
            const data = forgot.serialize();
            $.post('./api/forgot.php',data)
            .done(res=>{
                password.text(res);
            })
            .fail(err=>{
                alert(err);
            })
        }
    })
</script>