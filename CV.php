<!-- author notes 
Zeeshan Mohammed
Portfolio 3: http://210052026.cs2410-web01pvm.aston.ac.uk/CVAston/CV.php
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/CV.css">
    <title></title>
</head> <?php 
      session_start();
      
      //getting data from database
      $db_user = "u-210052026";
      $db_pass = "GlC1LK8UUMSXAjb";
      $db_name = "u-210052026_astoncv";
      $db_server = "localhost";
      
      
      
      
      $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
      
      if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
      }
      
      $sql = "SELECT * FROM cvs";
      $result = $conn->query($sql);
      $runner = $result;
      
      
      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              $id = $row['id'];
              $name = $row["name"];
              $email = $row["email"];
              $profile = $row["profile"];
              $keyprogramming = $row["keyprogramming"];
              $education = $row["education"];
              $URLinks = $row["URLlinks"];
      
          } 
          
      }
      
      ?>

<body>
    <header class="main-header" id="header" style="z-index:2;">
        <!-- main navigation links which are resposnvie and allows the user to go around all the site pages -->
        <title>CSAston - CV's</title>
        </head>

        <body>
            <style>
                body {
                background-image: url('Images/grayPolygon.png');
                }
            </style>
            <header class="main-header" id="header" style="z-index:2;">
                <nav>
                    <div class="Logo">
                        <h4>CSAston - CV's</h4>
                    </div>
                    <ul class="Nav-Links" style="z-index: 2;">
                        <li> <a href="Home.php">Home</a> </li>
                        <li> <a href="CV.php">CV's</a> </li>
                    </ul>
                    <div class="burger" id="burger" style="z-index: 2">
                        <div class="Line1"></div>
                        <div class="Line2"></div>
                        <div class="Line3"></div>
                    </div>
                </nav>
            </header> <!-- test -->
            <!-- small infomaiton about me -->
            <main class="Main-Panel">
                <!-- makes a table of multiple people and there data --> <?php 
               //Get number of rows
               $sql = "SELECT * FROM cvs";
               $result = $conn->query($sql);
               $i = 1;
               //declare an array of ids
               $id = array();
               //declare an array of names
               $name = array();
               //declare an array of emails
               $email = array();
               //declare an array of profiles
               $profile = array();
               //declare an array of keyprogramming
               $keyprogramming = array();
               //declare an array of education
               $education = array();
               //declare an array of URLinks
               $URLinks = array();

               
               if ($result->num_rows > 0) {
                   // output data of each row
                   while($row = $result->fetch_assoc()) {
                       $id[$i] = $row['id'];
                       $name[$i] = $row["name"];
                       $email[$i] = $row["email"];
                       $profile[$i] = $row["profile"];
                       $keyprogramming[$i] = $row["keyprogramming"];
                       $education[$i] = $row["education"];
                       $URLinks[$i] = $row["URLlinks"];
                       $i++;
               
               
                   } 
                   
               }
               //varible that gets the amount of items in a table
               
                  
               if(!isset($_GET['edit'])){ // if edit is false it means that the user did not click on their "more info"
                  
               
               
               
               ?>
                <!-- create a search bar for finding specfic items -->
                <div class="CV-Table" border="0" align="center">
                    <div class="Search-Bar">
                        <form action="CV.php" method="get"> <input class="bar" type="text" name="search" placeholder="Search" required> <input class="search" type="submit" name="submit_search" value="Search"> </form>
                    </div> <?php 
               // if search button is clicked, return the results of the search
               if(isset($_GET['submit_search'])){
                  
                  $search = $_GET['search'];
                  $query = "SELECT * FROM cvs WHERE name LIKE '$search' OR keyprogramming LIKE '$search'";
                  $runner = mysqli_query($conn, $query);
                  ?>
                    <!-- create a table that links to database -->
                    <table class="Table" border="5">
                        <tr class="Items" border="0">
                            <th>Name</th>
                            <th>Email</th>
                            <th>Key Programming</th>
                            <th>More Infomation Here</th>
                        </tr> <?php 
                     $num_rows = $runner->num_rows;

                     if (mysqli_num_rows($runner) > 0) {
                        $i = 1;
                        
                        while($row = $runner->fetch_assoc()) { // a loop that fetches all the data that matches the search query
                           $name_test[$i] = $row["name"];
                           $email_test[$i] = $row["email"];
                           $keyprogramming_test[$i] = $row["keyprogramming"];
                           $i++;
                   
                   
                       } 

                    }
                     
                     
                     // Loop through the results from the database
                     for ($x = 1; $x <= $num_rows; $x++) 
                     {
                        
                     
                     ?> <tr class="Item">
                            <th> <?php echo $name_test[$x]; ?> </th>
                            <th> <?php echo $email_test[$x]; ?> </th>
                            <th> <?php echo $keyprogramming_test[$x]; ?> </th>
                            <th> <button class="btn-more-info" type="button"><a href="CV.php?edit=<?php echo $email_test[$x]; ?>">More Info </a></button> </th>
                        </tr> <?php
                     }
                     
                     
                     ?>
                    </table> <?php
                  
                  
                  


               } else{
                     // this else is if there is nothing being searched
                     // it will just display the normal talbe with all of the data.
               

            ?> <table class="Table" border="5">
                        <tr class="Items" border="0">
                            <th>Name</th>
                            <th>Email</th>
                            <th>Key Programming</th>
                            <th>More Infomation Here</th>
                        </tr> <?php 

                     
                     
                     
                     // Loop through the results from the database
                     for ($x = 1; $x <= $result->num_rows; $x++) 
                     {
                     
                     ?> <tr class="Item">
                            <th> <?php echo $name[$x]; ?> </th>
                            <th> <?php echo $email[$x]; ?> </th>
                            <th> <?php echo $keyprogramming[$x]; ?> </th>
                            <th> <button class="btn-more-info" type="button"><a href="CV.php?edit=<?php echo $email[$x]; ?>">More Info </a></button> </th>
                        </tr> <?php
                     }
                     
                     
                     ?>
                    </table> <?php 
               }

               ?>
                </div> <?php 
               }
               else if (isset($_GET['edit'])) { // if edits true it means a user is logged in and they clicked on the "more info" button that matches there email.
               
               
               ?> <div class="Data-edit">
                    <!-- make table that allows you to edit data. Make it so that it redirects you to another page when you choose to edit the data. --> <?php 

               
               $sql = "SELECT * FROM cvs WHERE email = '$_GET[edit]'";
               
               
               
               
               $result = $conn->query($sql);
               // data that the user can edit and will then be updated to the data base.
               if ($result->num_rows > 0) {
                   // output data of each row
                   while($row = $result->fetch_assoc()) {
                       $Selected_ID = $row["id"];
                       $Selected_Name = $row["name"];
                       $Selected_Email = $row["email"];
                       $Selected_Profile = $row["profile"];
                       $Selected_KeyProgramming = $row["keyprogramming"];
                       $Selected_Education = $row["education"];
                       $Selected_URLinks = $row["URLlinks"];
                   } 
                   
               }
               
               ?> <div class="padder"></div>
                    <div class="form-details">
                        <div class="flex">
                            <div class="Box">
                                <div class="header">
                                    <h1> More Infomation - <?php echo $Selected_ID; ?></h1>
                                </div>
                                <div class="body"> <label class="Item">Name: </label> <?php echo $Selected_Name; ?> <br> <label class="Item">Email:</label> <?php echo $Selected_Email; ?> <br> <label class="Item">Profile:</label> <?php echo $Selected_Profile; ?> <br> <label class="Item">Key Programming:</label> <?php echo $Selected_KeyProgramming; ?> <br> <label class="Item">Education:</label> <?php echo $Selected_Education; ?> <br> <label class="Item">URL Links:</label> <?php echo $Selected_URLinks; ?> <br> </div> <?php
                        if($_SESSION != null){
                            if($_GET['edit'] == $_SESSION['email']){
                        ?> <?php
                        }
                        }
                        ?> <button class="btn-more-info3" type="button"> <a class="anchor-dec" href="CV.php" style="text-decoration: none;">Return To table</a> </button>
                            </div> <?php
                        if($_SESSION != null){
                            if($_GET['edit'] == $_SESSION['email']){
                        ?> <div class="Box">
                                <div class="header">
                                    <h1> Edit Data Here! - <?php echo $Selected_ID; ?></h1>
                                </div>
                                <div class="body">
                                    <!-- make a form that edits data -->
                                    <form action="CV.php" method="post"> <label class="Item">Name: </label><br> <input type="text" name="name" value="<?php echo $Selected_Name; ?>"> <br> <label class="Item">Email:</label><br> <input type="text" name="email" value="<?php echo $Selected_Email; ?>"> <br> <label class="Item">Profile:</label><br> <input type="text" name="profile" value="<?php echo $Selected_Profile; ?>"> <br> <label class="Item">Key Programming:</label><br> <input type="text" name="keyprogramming" value="<?php echo $Selected_KeyProgramming; ?>"> <br> <label class="Item">Education:</label><br> <input type="text" name="education" value="<?php echo $Selected_Education; ?>"> <br> <label class="Item">URL Links:</label><br> <input type="text" name="URLlinks" value="<?php echo $Selected_URLinks; ?>"> <br> <input class="btn-Submit" type="submit" name="update" value="Update Data"> </form>
                                    <style>
                                        .flex{
                                            padding-top: 50%;
                                            top: 10%;
                                        
                                        }
                                    </style> <?php
                        }
                        }
                        ?>
                                </div>
                            </div> <label> </label>
                        </div> <?php 
               }
            ?> <?php
               if(isset($_POST['update'])){  // this updates the data if the update data button is clicked on the edit form.
                $Selected_Email = $_POST['email'];
               
               $sql = "UPDATE cvs SET name = '$_POST[name]', email = '$_POST[email]', profile = '$_POST[profile]', keyprogramming = '$_POST[keyprogramming]', education = '$_POST[education]', URLlinks = '$_POST[URLlinks]' WHERE email = '$Selected_Email'";
                if ($conn->query($sql) === TRUE) {
                    echo "Record updated successfully";
                  ?> <script>
                            window.location.href = "CV.php"; // refreshes the entire page since the header in php was not working.
                        </script> <?php

                  
                } else {
                }

            }
            ?> <div class="padder2"></div>
            </main> <!-- cool footer that has icons that links to different pages of mine -->
            <section class="footer" style="z-index: 1;">
                <div class="copyright"> <label class="control-label"> <?php 
                  if(isset($_SESSION['email'])){
                      echo "Logged in as ".$_SESSION["name"]."!"; 
                      
                  
                  }else{
                      echo "Logged in as Guest!"."<br>";
                  } 
                  ?></label> </div> <?php
               if(isset($_SESSION['email'])){
               ?> <div class="Login-Panel">
                    <div class="Login-Panel-Body">
                        <form action="Home.php" method="post"> <input type="submit" name="Logout" value="Logout" class="form-control" placeholder="" id="Logout"> </form>
                    </div>
                </div> <?php 
               }
               ?>
            </section>
            <script src="js/Nav.js"></script>
        </body>
</html>