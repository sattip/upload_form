<?
include("database.php");
 include("functions.php");
class Session
{
    var $username;     //Username given on sign-up
   var $userid;       //Random value generated on current login
   var $userlevel;    //The level to which the user pertains
    
   function Session(){
      $this->time = time();
      $this->startSession();
   }

   function startSession(){
      global $database;  //The database connection
      session_start();   //Tell PHP to start the session     
      
        }
        function doLogins()
{
          $result = $database->dologin($subuser,$subpass);
        }
        };

$session = new Session;
 
      
?>
