// JavaScript Document
function lo(th,url)
{
	$.ajax(url,{cache:false,success: function(x){$(th).html(x)}})
}
function good(id)
{
	$.post("back.php?do=good&type="+type,{"id":id,"user":user},function()
	{
		if(type=="1")
		{
			$("#vie"+id).text($("#vie"+id).text()*1+1)
			$("#good"+id).text("收回讚").attr("onclick","good('"+id+"','2','"+user+"')")
		}
		else
		{
			$("#vie"+id).text($("#vie"+id).text()*1-1)
			$("#good"+id).text("讚").attr("onclick","good('"+id+"','1','"+user+"')")
		}
	})
}

function getPage(page,num) {
	    $.get(`./api/pop.php?do=${page}&page=${num}`)
    .done(res=>{
        $(".container").html(res)
    })
    .fail(err=>{
        console.log(err);
    })
}