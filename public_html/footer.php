<div class="purpBar">
					<img src="images/purplefadebar.jpg" alt="Davis And Davis" />
				</div>
				<div id="footer">
					<span class="smallText"><a href="../index.php?proid=about">About</a></span>
					<span class="smallText"><a href="../index.php?proid=contact">Contact</a></span>
					<span class="smallText"><a href="../index.php?proid=crelations">Customer Relations</a></span>
					<span class="smallText"><a href="mailto:feedback02@davisanddavisonline.com">Feedback</a></span>
					<span class="smallText"><a href="../index.php?proid=policies">Policies</a></span>
					<span class="smallText"><a href="login" class="signin">Admin</a></span>
					
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
					
				</div>
				<form name="ccoptin" action="http://ui.constantcontact.com/roving/d.jsp" target="_blank" method="post">
					<div style="text-align:center;">
						<div>
							Join our mailing list: <input onclick="fClearMailer(this);" style="background-color:#e6d0f0;" type="text" name="ea" size="25" value="Enter Your Email" />
							<input type="hidden" name="m" value="1100374215763" />
							<input type="hidden" name="p" value="oi" />
							<input type="submit" name="go" value="Go" />
						</div>
					</div>
				</form>
				<div id="note">
					&copy;2012 Davis &amp; Davis Gourmet Foods<br />
				</div>
				<form id="fm" action="http://www.davisanddavisonline.com/cgi-davisanddavisonline/sb/order.cgi" method="post">
				<input id="storeid" name="storeid" type="hidden" value="" />
				<input id="super" name="super" type="hidden" value="" />
				<input id="dbname" name="dbname" type="hidden" value="" />
				<input id="function" name="function" type="hidden" value="" />
				<input id="itemnum" name="itemnum" type="hidden" value="" />
				</form>