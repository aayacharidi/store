<?php
session_start();
require('basic/mysqli_conn.php'); 
require('basic/loginTest.php');
   $request_query=mysqli_query($conn,"SELECT * FROM game_request where receiver_id = '$u_team_id'");
   $is_null= mysqli_num_rows($request_query);
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
           <li><a href="requests.php">requests</a></li>
           <li>Join game Requests</li>
      </ul>
        <div class="body">
         <div class="g_table">
            <div class="game tit">
               <table>
                  <tr style='color: #CA2121'>
                     <td style="min-width: 450px;">Game Details</td>
                     <td>From</td>
                     <td>Date</td>
                     <td> </td>  
                  </tr>

               </table>
            </div>
            <?php 
            while ($result = mysqli_fetch_array($request_query)) { 
               ?>
               <div class="game">
                  <table>
                     <tr>
                        <td style="min-width: 450px;"><?php
                        echo $result[1];
                        ?></td>
                        <td><?php
                        echo $result[2];
                        ?></td>
                        <td><?php
                        echo $result[3];
                        ?></td>
                        <td class= "join_but"><a href="reject_g_request.php?message_id=<?php echo$result[4]?>"> Reject </a></td>
                        <td class= "join_but"><a href="accept_g_request.php?message_id=<?php echo$result[4]?>"> Accept </a></td>
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
                        <td style="color: #ffffff; min-width: 350px;"> There is no Join Team Requests</td>
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
mysqli_close($conn);
?>