<?php
include('simple_html_dom.php');
if(isset($_POST['submit']))
{
	if(strlen($_POST['usn'])<=8)
	{
		echo "<meta name=viewport content=width=device-width, initial-scale=1>";
		$url="http://results.vtu.ac.in/results".date("y")."/result_page.php?usn=";
		$sub=NULL;
		$dom=new simple_html_dom();
		$usn=$_POST['usn'];
		$url.=$usn;
		$fname=$usn.".html";
		if(!file_exists($fname))
		{
			$tags="<meta name=viewport content=width=device-width, initial-scale=1><link rel=stylesheet href=bootstrap.min.css>";
			for($index=1;$index<120;$index++)
			{
			//make index 3 digit
			if($index<100) $index=str_pad($index, 3, "0", STR_PAD_LEFT);
			$dom = file_get_html($url.$index);
			if($dom!=NULL)
			{
				if(strpos($dom,"alert(\"University Seat Number is not available or Invalid..!\");")==false)
				{
					$strt=strrpos($dom,"<div class=\"panel panel-info\">");
					$end=strpos($dom,"<div class=\"row\" style=\"text-align:right;margin-top:20px;margin-bottom:10px;font-family:Times New Roman;font-size:12pt;\">");
					$end-=$strt;
					$sub.=substr($dom,$strt,$end);
				}
			}
			if($sub!=NULL)
			{
					$myfile = fopen($usn.".html","w") or die("Unable to open file!");
					fwrite($myfile,$tags);
					fwrite($myfile,$sub);
					fclose($myfile);
			}
			}
	}
	if(!file_exists($fname))
	{
		die("<h1 style='text-align:center'>NO RESULT FOUND</h1>");
	}
	else header("location:$fname");
	}
}
?><head>
		<link rel="stylesheet" href="bootstrap.min.css"></link>
	    <link rel="icon" href="DSC_1171_edit.JPG"></head>
		<body style="background:url(plain19.jpg); background-size:cover;">
	 <nav class="navbar navbar-inverse">
	<div class="navbar-header"><a href="index.html">
<h1 id="head1" class="navbar-brand navbar-text" style="color:white; font-size:44px;">Toce-Results</h1></a>
	</div>
	 <div class="collapse navbar-collapse" id="myNavbar">
<ul class="nav navbar-nav navbar-right navbar-text" style="color:white; font-size:34px;" >
      <li><a href="index.html">Home</a></li>
      <li><a href="contact.html">Contact</a></li>
      <li class="active"><a href="adminpage.html">Admin</a></li>
    </ul>	
	</div>
</nav>
<div class="row">
	 <div class="col-title"><h1 style="text-align:center; color:navy; font-size:40px;"><strong>Class Result</strong></h1></div>
	 <hr/>
	<fieldset style="text-align:center;">
 	 <h3 style="text-align:center; font-size:30px;">Enter the first 7 letters of the USN.</h3>
<form method="post" action=<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>>
	 <h3 style="text-align:center;font-size:30px;"><strong>USN:</strong></h3>
	 <input name="usn" placeholder="First 7 digits of usn here" size="20" pattern="[1-4]{1}[a-z]{2}[1-9]{2}[a-z]{2}" autocomplete="off" required style="display:inline-block; align:center;" value=""></input>
	 <br/>
	 <br/>
	 <button class="btn" style="background-color:black; color:white; padding:5px 25px;" value="submit1" name="submit"><strong>SUBMIT</strong></button>
</form>
</fieldset>
<div>
<hr/>
<div class="footer container-fluid" style="background:black; position:absolute; bottom:5px; width:99%; ">
<a href="https://github.com/rahuljain5" ><img src="github_icon.png" alt="github logo" height="35px" width="35px" ></img></a>
<h5 style="color:white; float:right;">By <b>Rahul Jain<b></h5>
</div>
</body>
