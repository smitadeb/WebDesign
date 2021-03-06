<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Reddit Top Content - Live</title>
<link href="css/final.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<script type="text/javascript">
var domain;
var ups;
var downs;
var thumb;
var url;
var title;
var score;
var refreshes = 0;
var ctext;
var refreshevery = "15000"

function loadChirp(){

	$.getJSON("http://www.reddit.com/.json?jsonp=?", function(data) {
	
	var ctext = "";
	$.each(data.data.children, function(key, val) {
		var dom = val.data.domain;
		var up = val.data.ups;
		var down = val.data.downs;
		var thumb = val.data.thumbnail;
		var urls = val.data.url;
		var title = val.data.title;
		var score = val.data.score;
		var commentcnt = val.data.num_comments;
		var subreddit = val.data.subreddit;
		var author = val.data.author;
		var urlstring = "";
		if(urls.indexOf("jpg") != "-1"){
			urlstring ="<img src='"+urls+"' width='100%'>";
		}
		if(urls.indexOf("png") != "-1"){
			urlstring ="<img src='"+urls+"' width='100%'>";
		}
		
	
		ctext = ctext + "<div class='content'><div class='contenttop'><h3><a href='"+urls+"'target='_blank'>"+ title+"</a></h3></div><h5>Subreddit: "+subreddit+" Author: "+author+" Score: "+score+" Up:"+up+" Down:"+down+" </h5>"+urlstring+"</div>";
		
		
	  });
	
	document.getElementById('Reddit').innerHTML = ctext;
	refreshes = refreshes + 1;
	document.getElementById('header').innerHTML = "<h1>Live Reddit Feed <br>Refreshed:"+refreshes+" Times</h1>";
	})
.error(function() { alert("Something Happened That Shouldn't Have, Sorry.."); });
	
	
setTimeout("loadChirp()",refreshevery);
}

	

</script>
</head>

<body id="backgroundreddit" ">

<div class="wrapper">

<div id="header" class="header">
<h1>Live Reddit Feed</h1>
</div>
<br>
<?php include "menu.php" ?>



<div class="content">
<div class="contenttop">Info</div>
<ul>
<li>This page works by repeatedly pulling the .json file for the Reddit frontpage, and styling that data.</li>
<li> Given that the content comes from an external source, I am not responsible for the content.</li>
<li>Think of it as a simple tech demo for the Reddit API</li>
<li>Parents, hide your children!</li>
</ul>
<br>
<center><input type="button" value="I understand" onclick="loadChirp();"></center>
</div>
<div id="Reddit"> </div>


<?php include "footer.php" ?>

</div>
</body>
</html>
