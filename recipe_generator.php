<div id="prodTitle">
				<div>KEN'S RECIPES</div>
		</div>
		
		<!--BAR-->
		<div class="purpBar">
			<img src="images/purplefadebar.jpg" alt="" />
		</div>
		<div id="prodInfoText">
			<div>
			<div class="backer" onclick="javascript:window.history.back();">BACK</div>
				<br /><table>
          <tr> 
            <td valign="top">
								<p>We would love to hear what you create with <strong>Davis 
                &amp; Davis</strong> products. <br />Please email us your 
                favorite <strong>Davis &amp; Davis </strong> recipe 
                to our <a href="mailto:customerrelations@davisanddavisonline.com">Customer 
                Relations</a> team. 
                </p>
                </td>
                </tr>
                
               <?php  
             $con = mysql_connect("localhost","davis","davis");
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}

               mysql_select_db("davisanddavis", $con);
               $sql= "SELECT * FROM recipes where active=1";
               $result = mysql_query($sql);
              
            echo '<ul>';
            while ($row = mysql_fetch_array($result))
            {
            echo '<li><a href="#'.$row['id'].'">'.base64_decode($row['recipe_name']).'</a></li>';
            }
            echo '</ul>';
            
            echo '<tr>';
            while ($row = mysql_fetch_array($result))
            {
            	
            echo '<td valign="top"><h1><a name="'.$row['id'].'" id="'.$row['id'].'"></a>'.$row['recipe_name'].'</h1>';
            
            }
            echo '</tr>';
            //require_once("public_html/db_close.php");
            mysql_close($con);
            ?>
            </table>
</div>