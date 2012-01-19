<style type="text/css">
<!--
.style1 {font-family: Verdana, Arial, Helvetica, sans-serif}
-->
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="48%"><div align="center">
      <p align="left"><span class="footer"><img src="../img/spacer.gif" alt="sapcer"><img src="../img/spacer.gif" alt="sapcer"><img src="../img/spacer.gif" alt="sapcer"><img src="../img/spacer.gif" alt="sapcer"><a href="contact.php"><font color="#999999" size="1">Contact</font></a>&nbsp; | &nbsp;<a href="faqs.php"><font color="#999999" size="1">Customer
              Relations</font></a> &nbsp;|&nbsp; <a href="mailto:feedback02@davisanddavisonline.com"><font color="#999999" size="1">Feedback</font></a>&nbsp;|&nbsp; <font color="#999999" size="1"><a href="policies.php"><font color="#999999" size="1">Policies</font></a></font><br />
            <br />
		  <font color="#666666"><img src="../img/spacer.gif" alt="sapcer"><img src="../img/spacer.gif" alt="sapcer"><img src="../img/spacer.gif" alt="sapcer"><img src="../img/spacer.gif" alt="sapcer">&copy; 
		  2006 Davis &amp; Davis Gourmet Foods </font><br />
            <br />
            
      <p>&nbsp;</p>
    </div></td>
    <td width="50%" valign="top"><!-- BEGIN: Constant Contact HTML for OptIn Tag  -->
<center>
<form name="ccoptin" action="http://ui.constantcontact.com/roving/d.jsp" target="_blank" method="post">
<table bgcolor="lightyellow" border="1" bordercolor="#ABC36E" cellpadding="3" cellspacing="0">
<tr><td align="center"><span class="style1"><font color="#999999" size="1">Join
        the�<b>Davis & Davis Gourmet Foods</b>�mailing list�</font></span></td>
</tr>
<tr><td align="center"><span class="style1"><font color="#999999" size="1"><b>Email:</b>
        <input type=text name="ea" size=25>
        <input type=hidden name="m" value="1100374215763">
        <input type=hidden name="p" value="oi">
        <input type=submit name="go" value="Go">
</font></span></td>
</tr>
</table></form>
</center>
<!-- End: Constant Contact HTML for OptIn Tag --></td>
  </tr>
</table>

<div style="text-align:right;font-weight:bold;">
<div id="container">
 <a href="login" class="signin"><span>Admin</span></a>  
  <fieldset id="signin_menu">
    <form method="post" id="signin" action="http://slomaro34.servebeer.com/public_html/check_login.php">
      <label for="username">Username</label>
      <input id="username" name="myusername" value="" title="username" tabindex="4" type="text">
      </p>
      <p>
        <label for="password">Password</label>
        <input id="password" name="mypassword" value="" title="password" tabindex="5" type="password">
      </p>
      <p class="remember">
        <input id="submit" value="Login" name="Submit" tabindex="6" type="submit">
      </p>
    </form>
  </fieldset>
</div>



<script src="../javascripts/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
        $(document).ready(function() {

            $(".signin").click(function(e) {
                e.preventDefault();
                $("fieldset#signin_menu").toggle();
                $(".signin").toggleClass("menu-open");
            });

            $("fieldset#signin_menu").mouseup(function() {
                return false
            });
            $(document).mouseup(function(e) {
                if($(e.target).parent("a.signin").length==0) {
                    $(".signin").removeClass("menu-open");
                    $("fieldset#signin_menu").hide();
                }
            });            

        });
</script>
