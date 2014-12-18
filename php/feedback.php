<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Sambhashana Sandesha</title>
<script language="javascript">
function checkField(f1, tbl1,tbl2)
{
	if((f1.name.value=="") )
	{
	  document.getElementById(tbl1).style.display = '';
      return false;
	 }
	else if((f1.email.value=="") )
    {
	  document.getElementById(tbl2).style.display = '';
      return false;
    }
	
	
	else return true;
}
</script>
<!-- InstanceEndEditable -->
<link href="style/Style.css" rel="stylesheet" />
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>

<body>

<div id="container">
	<div id="header">
    <div id="ctct">
    Email : samskritam@gmail.com<br/>
    Phone : 9900223344
    </div>
    <div id="head1"></div>
    	<div id="menu">
    	<div id="navcontainer">
        <ul id="navlist">
			<li id="active"><a href="../index.php">HOME(उपक्रमः)</a></li>
			<li><a href="about.php">ABOUT US(परिचयः)</a></li>
			<li><a href="subscribe.php">SUBSCRIBE(ग्राहकता)</a></li>
			<li><a href="feedback.php">FEEDBACK(प्रतिपुष्टिः)</a></li>
            <li><a href="contact.php">CONTACT US(सम्पर्कः)</a></li>
            <li><a href="advertise.php">ADVERTISE(विज्ञापना)</a></li>
            <li><a href="volume.php">ARCHIVE(संग्रह)</a>
			<ul id="nav">
				<li><a href="volume.php">VOLUMES</a></li>
				<li><a href="show_article.php?letter=अ">ARTICLES</a></li>
				<li><a href="show_author.php">AUTHORS</a></li>
				<li><a href="feature.php">FEATURES</a></li>
				<li><a href="search.php">SEARCH</a></li>
			</ul>
		</li>
		</ul>
		</div>
    </div>
    </div>
	<div id="cnt">
    	<div id="hcnt1">
        </div>
    	<div id="hcnt2">
       	  <div id="hcontent"><!-- InstanceBeginEditable name="EditRegion3" -->


       	    <h1>Feedback</h1>
       	    <br />
        <form name="f1" method="post" action="http://tulu.in/samskritam/sendmail2.php">
<table width="578" border="0" align="center" cellpadding="0" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif; font-size:10pt;">
 
  <tr>
    <td width="8" height="25"><p>&nbsp;</p></td>
    <td width="132"><p>Name *</p></td>
    <td width="12" height="25"><p><strong>:</strong></p></td>
    <td width="187" height="25"><p><input name="name" type="text" id="name" /></p></td>
    <td width="183" height="25">
   
        <table width="150" border="0" cellspacing="0" cellpadding="0" id="tbl1" style="display:none; color:#FF0000">
           <tr>
               <td>Enter the Name</td>
            </tr>
        </table>  
    </td>
    
  </tr>
  
 <tr>
    <td height="25"><p>&nbsp;</p></td>
    <td height="25"><p>Email Id *</p></td>
    <td height="25"><p><strong>:</strong></p></td>
    <td height="25"><p><input name="email" type="text" id="email" /> </p></td>
    <td height="25">
    
    	<table width="150" border="0" cellspacing="0" cellpadding="0" id="tbl2" style="display:none; color:#FF0000">
  			<tr>
    			<td>Enter the Email Id</td>
  			</tr>
		</table> 
   </td>
   </tr>
  <tr>
    <td height="25"><p>&nbsp;</p></td>
    <td height="25"><p>Phone No</p></td>
    <td height="25"><p><strong>:</strong></p></td>
    <td height="25"><input name="phone" type="text" id="phone" /></td>
    <td height="25"><p>&nbsp;</p></td>
    </tr>
  
  <tr>
    <td height="25"><p>&nbsp;</p></td>
    <td height="25" valign="middle"><p>Address</p></td>
    <td height="25"><p><strong>:</strong></p></td>
    <td height="25"><p><textarea name="addr" cols="25" rows="5"></textarea></p></td>
    <td height="25"><p>&nbsp;</p></td>
    </tr>
  <tr>
    <td><p> &nbsp;</p></td>
    <td><p> Subject</p> </td>
    <td><p> : </p></td>
    <td> <input type="text" name="sub"  /></td>
    <td height="25"><p>&nbsp;</p></td>
 
  <tr>
    <td height="95"><p>&nbsp;</p></td>
    <td height="95"><p>Feedback</p></td>
    <td height="95"><p><strong>:</strong></p></td>
    <td height="95"><p><textarea name="feedback" cols="25" rows="5" id="feedback">&nbsp;</textarea></p></td>
    <td height="25"><p>&nbsp;</p></td>
    </tr>
  
  <tr>
    <td height="25" colspan="2"><p>&nbsp;</p></td>
    <td height="25"><p>&nbsp;</p></td>
    <td height="25">
      <p>
          <input name="" type="submit" value="Submit" onclick="return checkField(f1,'tbl1','tbl2');"  /> 
          &nbsp;
          <input name="input4" type="reset" value="Reset" />
      </p></td>
    </tr>
</table>
</form>
            
  
       	  <!-- InstanceEndEditable --></div>
        	<div id="iss">
                	<div id="hcnt7">
						<div id="latest">
						<a href="lat_issue.php"><img src="images/0001.jpg" alt="Latest Issue" width="150px" height="200px"/></a>
<?php

include("connect.php");

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");

$month_name = array("1"=>"जनवरी","2"=>"फेब्रवरी","3"=>"मार्च्","4"=>"एप्रिल्","5"=>"मे","6"=>"जून्","7"=>"जुलै","8"=>"अगस्ट्","9"=>"सप्टम्बर्","10"=>"अक्टोबर्","11"=>"नवम्बर्","12"=>"डिसेम्बर्");

$query = "select distinct month,year,volume,issue from article where volume='019' and issue='04'";
$result = mysql_query($query);

$num_rows = mysql_num_rows($result);

if($num_rows)
{
	$row=mysql_fetch_assoc($result);

	$year=$row['year'];
	$month=$row['month'];
	$volume=$row['volume'];
	$issue=$row['issue'];

	echo "<span class=\"title\"><br />&nbsp;&nbsp;<a href=\"lat_issue.php\">सम्पुट:&nbsp;".intval($volume).",  सञ्चिका:&nbsp;".intval($issue)."<br />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$month_name{intval($month)}."&nbsp;$year</a><br /><br />
				</span><br /><br />";
}

?>						
						</div>
                    <div id="tablespace">
	

                	</div>
                  
                    <table border="0">
                      
                      <tr>
                        <td><form id="form1" name="form1" method="post" action="">
                          <label></label>
                        </form>                        </td>
                        <td>&nbsp;</td>
                        <td><form id="form2" name="form2" method="post" action="">
                          <label></label>
                        </form>                        </td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><div align="right"></div></td>
                      </tr>
                    </table>






                      </p></div>
            	</div>
 <p align="center"> <img src="images/Img.jpg" width="728" height="70" /></a><br />


        </div>	
        <div id="hcnt3"><img src="images/2.gif" /></div>

        	<div id="footer">Copyright &copy; 2010 <a class="two" href="">www.samskrita.in</a> All Rights Reserved. Powered By 
<a href="http://dhyeyatech.com" target="_blank" class="two">DhyeyaTech</a>  and
<a href="http://www.vyomalabs.in/" target="_blank" class="two">Vyoma Linguistic Labs Foundation</a> 
       </div>	
  </div>
</div>
</div>
</body>
</html>
