<!DOCTYPE html>
<html>
<head>
	<title>demo</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(function(){
    $('div').hide();
    $('button').click(function(){
        $('div').show();
        
    });
});
</script>
</head>


</head>
<body>
<style>
#demo{
	color :green;
	font: 10px;
}

</style>
<p id="demo">xxx</p>

<button type="button" id="btnLike">like</button>
<script type="text/javascript">
	document.getElementById("btnLike").addEventListener("click", function(){

    	document.getElementById("demo").style.color="red";
	});

</script>
<p><button>Click</button></p>
<div>Đây là thành phần được ẩn</div>
</body>
</html>



