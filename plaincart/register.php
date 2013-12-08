 
<h1>Register</h1>

<form action="process.php" method="POST" onsubmit="regvalidate()" name="regform">
<table align="left" border="0" cellspacing="0" cellpadding="3">
<tr><td>Username:</td><td><input type="text" name="user" maxlength="30" value=""></td></tr>
<tr><td>Password:</td><td><input type="password" name="pass" maxlength="30" value=""></td></tr>
<tr><td>Email:</td><td><input type="text" name="email" maxlength="50" value=""></td></tr>
<tr><td colspan="2" align="right">
<input type="hidden" name="subjoin" value="1">
<input type="submit" value="Join!"></td></tr>
<tr><td colspan="2" align="left"><a href="main.php">Back to Main</a></td></tr>
</table>
</form>
<script type="text/javascript">

function regvalidate()
{
var uname = document.regform.user.value;  
var upass = document.regform.pass.value; 
var uemail = document.regform.email.value; 
var atpos=uemail.indexOf("@");
var dotpos=uemail.lastIndexOf(".");
if(uname==null || uname=="")
   {
    alert("User name name must be filled out");
    return false;
   }
if(upass==null || upass == "")
   {
    alert("Please Fill Password ");
    return false;
   }
  if (upass.length<4)
    {
     alert("Password must be greater than 4 character");
     return false; 
    }
if(uemail==null || uemail=="")
   {
    alert("Email must be filled out");
    return false;
   }
 if (atpos<1 || dotpos<atpos+2 || dotpos+2>=uemail.length)
  {
  alert("Not a valid e-mail address");
  return false;
  }
}
</script>