<?php

if ($content = $_POST['content']) {
	$file=fopen("cat","w+");
	fwrite($file,$content);
	echo fread($file,filesize($file));
	fclose($file);
}

?>


<html>
<head>
<meta charset="utf-8">
<title>Paste Here</title>
<style type="text/css">

element.style {
    background-attachment: fixed;
    background-repeat: no-repeat;
    border-style: solid;
    border-color: #FFFFFF;
    margin-top: 40px;
    border-top-width: 5px;
    padding-top: 2px;
}

textarea, select {
    margin-top: 40px;
    text-rendering: auto;
    color: initial;
    letter-spacing: normal;
    word-spacing: normal;
    text-transform: none;
    text-indent: 0px;
    text-shadow: none;
    display: inline-block;
    text-align: start;
    margin: 0em;
    /*font: 12px system-ui;*/
    font-style: normal;
    font-variant-ligatures: normal;
    font-variant-caps: normal;
    font-variant-numeric: normal;
    font-weight: normal;
    font-stretch: normal;
    font-size: 14px;
    line-height: normal;
    font-family: SFMono-Regular, Consolas, "Liberation Mono", Menlo, Courier, monospace, "Monaco", "SF Pro SC", "SF Pro Text", "SF Pro Icons", "PingFang TC Medium", "Helvetica Neue", "Helvetica", "Arial", sans-serif;
    /*color: transparent;*/
    color: rgba(0, 0, 0, 0.5);
    text-shadow: 0 0 0.1px #000;
    /*font-size: 20px;*/
}
input, button {
    font-size: 16px;
    /*font-family: SFMono-Regular;*/
    padding:5px 11px;
    background:#fff;
    border:0 none;
    /*cursor:pointer;*/
    -webkit-border-radius: 5px;
    border-radius: 5px;
    }
.comments {
    width: 70%;
    height: 80%;
    overflow: auto;
    word-break: break-all;
}

</style>
</head>
<body>
<center>
<form action="" method="post">
<div id="collapse-panel-4" class="am-panel-bd am-collapse am-in">
    <textarea class="comments" name="content" rows="20" cols="80" style="background-attachment: fixed; background-repeat: no-repeat; border-style: solid; border-color: #FFFFFF; margin-top: 35px; border-top-width: 10px;"><?php echo file_get_contents("cat");?></textarea>
</div>
<br><br>
<input type="submit" value="Submit">
<input type="button" value="Refresh" onclick="location.href='index.php'">
</form>
</center>
</body>
</html>
