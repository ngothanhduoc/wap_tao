<?php 
//header('Location: http://portal.mobo.vn/');
//exit;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>404 Page Not Found</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style type="text/css">

::selection{ background-color: #E13300; color: white; }
::moz-selection{ background-color: #E13300; color: white; }
::webkit-selection{ background-color: #E13300; color: white; }

body {
	background-color: #fff;
	margin: 40px;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
}

a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}

h1 {
	color: #444;
	background-color: transparent;
	border-bottom: 1px solid #D0D0D0;
	font-size: 19px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
}

code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}

#container {
	margin: 10px;
	border: 1px solid #D0D0D0;
	-webkit-box-shadow: 0 0 8px #D0D0D0;
}

p {
	margin: 12px 15px 12px 15px;
}


#content_e{
    width: 690px;
    height: 270px;
    position: absolute;
    top: 50%;
    left: 50%;
    margin-top: -135px;
    margin-left: -345px;
    text-align: center;
    font-size: 16px;
}
#content_e ul.menu{
    padding: 0px;
    margin: 0px auto;
    width: 420px;
}
#content_e ul.menu li{
    list-style: none;
    float: left;
}
#content_e ul.menu li a{
    display: block;
    padding: 7px 15px;
    text-decoration: none;
    text-transform: uppercase;
    color: #494949;
    font-weight: bold;
}
#content_e ul.menu li a:hover, #content_e ul.menu li a.active{
    background: #e30114;
    color: #fff;
}
</style>
</head>
<body>
    <div id="content_e">
        <img src="/frontend/assets/images/error-404.png">
        <p>OPPS!! Trang của bạn muốn truy cập không tìm thấy</p>
        <ul class="menu">
            <li><a href="/">Trang chủ</a></li>
            <li><a href="/tin-tuc.moi">Tin tức</a></li>
            <li><a href="/video.moi">Video</a></li>
            <li><a href="/giftcode.moi">Giftcode</a></li>
        </ul>
    </div>
	<?php 
        /*
        <div id="container">
		<h1><?php echo $heading; ?></h1>
		<?php echo $message; ?>
	</div>
        */
        ?>
    
</body>
</html>