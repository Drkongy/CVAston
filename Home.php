<!-- author notes 
Zeeshan Mohammed
Portfolio 3: http://210052026.cs2410-web01pvm.aston.ac.uk/CVAston/Home.php
-->




<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer"
         />
      <link rel="stylesheet" href="css/Home.css">
      <title></title>
   </head>
   <body>
      <header class="main-header" id="header" style="z-index:2;">
      <!-- main navigation links which are resposnvie and allows the user to go around all the site pages -->
      <title>CSAston</title>
      </head>
      <body>
         <style>
            body {
            background-image: url('Images/grayPolygon.png');
            }
         </style>
         <header class="main-header" id="header" style="z-index:2;">
            <!-- main navigation links which are resposnvie and allows the user to go around all the site pages -->
            <nav>
               <div class="Logo">
                  <h4>CSAston</h4>
               </div>
               <ul class="Nav-Links" style="z-index: 2;">
                  <li>
                     <a href="Home.php">Home</a>
                  </li>
                  <li>
                     <a href="CV.php">CV's</a>
                  </li>
               </ul>
               <div class="burger" id="burger" style="z-index: 2">
                  <div class="Line1"></div>
                  <div class="Line2"></div>
                  <div class="Line3"></div>
               </div>
            </nav>
         </header>
         <div>


            <?php
            // connects to the database
            $db_user = "u-210052026";
            $db_pass = "GlC1LK8UUMSXAjb";
            $db_name = "u-210052026_astoncv";
            $db_server = "localhost";
               
               
               
               $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
               session_start(); // starts the session so that data can read.
               
               if (!$conn) {
                   die("Connection failed: " . mysqli_connect_error());
               }
               
               
               
               $error = "";
               $LoggedIn = false;
               $name = "";
               
               
               if(isset($_POST['submit'])){ // when the submit button is pressed for the loggin form
                   $email = $_POST['email'];
                   $password = $_POST['password'];
                   $sql = "SELECT * FROM cvs";
                   $result = mysqli_query($conn, $sql);
                   $error = "test";
                   //check if email is in the database and check if passwords matches
                   if (mysqli_num_rows($result) > 0) {
                       while ($row = mysqli_fetch_assoc($result)) {
                           if($email == $row["email"]){
                               $passcheck = password_verify($password, $row['password']);//Verify password
                               if($passcheck){
                                   $LoggedIn = true;
                                   $name = $row["name"];
                                   $_SESSION['id'] = $row["id"];
                                   $_SESSION['email'] = $row["email"];
                                   $_SESSION['name'] = $row["name"];
                               }else{
                                   $error = "Incorrrect Password";
                               }
                           }else{
                               $error = "Incorrect Email";
                           }
                       }
                   }    
                   mysqli_close($conn); // closes the connection
                   
               }
               
               
               if(isset($_POST['Logout'])){ // this is for when the user wants to log out
                   $LoggedIn = false;
                   session_unset();
                   session_destroy();
                   header("Location: Home.php"); // refreshes the page so the user can log out.
               
               }
               
               
               
               
               
               ?>
         </div>
         <main class="Main-Panel">
            <?php
               if(isset($_SESSION['email'])){
                   echo "<h1>Welcome back " . $_SESSION["name"] . "</h1>";
               
               ?>
            <a href="CV.php" class="link-cv"><?php echo "Press here to check out Cv's" ?></a>
            <?php
               }
               ?>
         </main>
         <section class="footer" style="z-index: 1;">
            <?php 
               if(!isset($_SESSION['email'])){ // this is shown if there isnt a session (no one logged in.)
               ?>
            <div class="Login-Panel">
               <div class="Login-Panel-Body">
                  <form action="Home.php" method="post">
                     <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                     <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                     <input type="submit" name="submit" id="submit">
                  </form>
               </div>
               <div class="error">
                  <label class="control-label"><?php echo $error; ?></label>
               </div>
               <div class="register">
                  <a href="Register.php">Register Here!</a>
               </div>
            </div>
            <?php 
               }
               else{
               
               // otherwise this is shown if there is a session (someone is logged in.)
                 
               ?>
            <label class="control-label"><?php echo "Logged in as ".$_SESSION["name"]. "!"; ?></label>
            <div class="Login-Panel">
               <div class="Login-Panel-Body">
                  <form action="Home.php" method="post">
                     <input type="submit" name="Logout" value="Logout" class="form-control" placeholder=""id="Logout">
                  </form>
               </div>
            </div>
            <?php 
               }
               
               ?>    
         </section>
         <!-- the script makes the navigation bar aniamted. -->
         <script src="js/Nav.js"></script> 

   </body>
</html>