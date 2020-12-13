<?php
session_start();
require('basic/mysqli_conn.php'); 
require('basic/loginTest.php');

$result = mysqli_query($conn,"select team_name from team where team_id = (select team_id from user where user_name = '$login_user')") or die ('database error: '.mysql_error());
if($result and mysqli_num_rows($result)!=0)
{
   join_game($is_captain);
}
else
   join_team();
function join_team()
{
   include 'basic/loginTest.php';
   ?>
   <!DOCTYPE html>
   <html>
   <head>
      <link rel="stylesheet" type="text/css" href="HomePage_Style.css">
      <link rel="icon" type="image/png" href="img/S63_old.png">
      <title>Sport Event Management</title>
   </head>
   <body>


      <div class="body_back">
         <?php
         include 'basic/navigation.php';
         ?>
         <ul class="breadcrumb">
           <li><a href="homePage.php">Home</a></li>
           <li><a href="game.php"> Game</a></li>
           <li>Join Game</li>
        </ul>
        <div class="body">
         <div class="main-body">
            <div class="row">
               <a href='joinTeam.php' class='main-button join_first'>
                  <div class="ball"></div>
                  <span>Click to Join a Team First!!</span>
               </a>
            </div>
            <div class="row">
               <a href='createTeam.php' class='main-button join_first'>
                  <div class="ball"></div>
                  <span>Or Click to Create a Team First!!</span>
               </a>
            </div>
         </div>
      </div>
      <?php
      include 'basic/bottom.php';
      ?>
   </div>


</body>
</html>
<?php
}

function join_game($is_captain)
{    include 'basic/loginTest.php';
   $result=mysqli_query($conn,"select team_name from team where team_id = (select team_id from user where user_name = '$login_user')") or die ('database error: '.mysql_error());
   $result = mysqli_fetch_array($result);
   $team_name =$result[0];
   if($is_captain==0 ){
   $game_query=mysqli_query($conn,"SELECT * FROM join_game where team_name <> '$team_name' and game_id not in (select game_id from message where sender_id = $user_id and type = 'to captain' and status = 'new')");
   $is_null = mysqli_num_rows($game_query);
   }
   else{
   $game_query=mysqli_query($conn,"SELECT * FROM join_game where team_name <> '$team_name' and game_id not in (select game_id from message where sender_id = $u_team_id and type = 'join game request')");
   $is_null = mysqli_num_rows($game_query);}
   ?>
   <!DOCTYPE html>
   <html>
   <head>
      <link rel="stylesheet" type="text/css" href="HomePage_Style.css">
      <link rel="stylesheet" type="text/css" href="resultDisplay.css">
       <link rel="icon" type="image/png" href="img/S63_old.png">
      <title>Sport Event Management</title>
   </head>
   <body>


      <div class="body_back">
         <?php
         include 'basic/navigation.php';
         ?>
         <ul class="breadcrumb">
           <li><a href="homePage.php">Home</a></li>
           <li><a href="game.php"> Game</a></li>
           <li>Join Game</li>
        </ul>
        <div class="body">
         <div class="g_table">
            <?php
            if($is_captain == 0){
            ?>
            <div class="game tit">
               <table>
                  <tr style='color: #CA2121'>
                     
                     <td style="width: 1100px;">When you click on an 'interested ' button , a message will send to your team captain.  </td>  
                  </tr>

               </table>
            </div>
            <?php } ?>
            <div class="game tit">
               <table>
                  <tr style='color: #CA2121'>
                     <td>Team Name</td>
                     <td>Date</td>
                     <td>Time</td>
                     <td>Location</td>
                     <td>Game Type</td>
                     <td>Duration</td>
                     <td> </td>  
                  </tr>

               </table>
            </div>
            <?php 
            while ($result = mysqli_fetch_array($game_query)) { 
               ?>
               <div class="game">
                  <table>
                     <tr>
                        <td><?php
                        echo $result[2];
                        ?></td>
                        <td><?php
                        echo $result[3];
                        ?></td>
                        <td><?php
                        echo $result[4];
                        ?></td>
                        <td><?php
                        echo $result[5];
                        ?></td>
                        <td><?php
                        echo $result[6] .":".$result[6];
                        ?></td>
                        <td><?php
                        echo $result[7];  
                        ?></td>
                        <?php
                           if($is_captain ==0){
                        ?>
                        <td class= "join_but"><a href="to_captain.php?game_id=<?php echo$result[0]?>"> interested </a></td>
                        <?php } else { ?>
                        <td class= "join_but"><a href="game_info.php?game_id=<?php echo$result[0]?>"> join </a></td>
                        <?php }?>
                     </tr>

                  </table>
               </div>
               <?php 
            }
            if($is_null == 0){
               ?>
               <div class="game" style=" display: inline-flex; ">
                  <table>
                     <tr>
                        <td style="color: #ffffff; width: 400px ;"> There is no upcoming Games</td>
                     </tr>
                  </table>
               </div>
               <?php } ?>

            </div>


         </div>
         <?php
         include 'basic/bottom.php';
         ?>
      </div>


   </body>
   </html>
   <?php
}
mysqli_close($conn);
?>