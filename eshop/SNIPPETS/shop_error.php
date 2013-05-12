//Etomised by Cris D.
//Save this as a snippet called "shop_error.php"

require_once 'plaincart/library/config.php';

$output =
<<<ERRORPAGE
<p>&nbsp;</p><table width="500" border="0" align="center" cellpadding="1" cellspacing="0">
   <tr> 
      <td align="left" valign="top" bgcolor="#333333"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr> 
               <td align="center" bgcolor="#EEEEEE"> <p>&nbsp;</p>
                        <p>We are really sorry for this inconvenience but there 
                            was an error when processing your order. Please contact 
                            the site administrator. To go to the main page please 
ERRORPAGE;

$output .="<a href=\"".$etomite->makeURL($etomite->documentIdentifier,'','')."\">click here</a>";

$output .=
<<<ERRORPAGE
                       </p>
                  <p>&nbsp;</p></td>
            </tr>
         </table></td>
   </tr>
</table>
<br />
<br />
ERRORPAGE;

return $output;