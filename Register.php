<!-- author notes 
Zeeshan Mohammed
Portfolio 3: http://210052026.cs2410-web01pvm.aston.ac.uk/CVAston/Register.php
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/Register.css">
    <title></title>
</head>

<body>
    <header class="main-header" id="header" style="z-index:2;">
        <!-- main navigation links which are resposnvie and allows the user to go around all the site pages -->
        <title>CSAston - Registration</title>
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
                        <h4>CSAston - Registration</h4>
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
            </header>
            <div> <?php
            $db_user = "u-210052026";
            $db_pass = "GlC1LK8UUMSXAjb";
            $db_name = "u-210052026_astoncv";
            $db_server = "localhost";
            //connects to the database
            $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $error = "";
            $loginNow = "";
            $emailUsed = false;

            if (isset($_POST['submit'])) {
                // this is for the register button
                $name = $_POST['name'];
                $email = $_POST['email'];
                $confirm_email = $_POST['confirm-email'];
                $password = $_POST['password'];
                $confirm_password = $_POST['confirm-password'];
                $emailUsed = false;
                $hashed_password = "";

                // this checks if the emails are matching and if the passwords are matching.
                if ($email == $confirm_email) {
                    if ($password == $confirm_password) {
                        $sql = "SELECT * FROM cvs";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            // output data of each row
                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($email == $row["email"]) {
                                    $error = "Email already exists in the database, Please use another one!";
                                    $emailUsed = true;
                                }
                            }

                            if ($emailUsed == false) {
                                //hash passowrd here
                                $hashed_password = password_hash($password, PASSWORD_DEFAULT); // this makes the password hashed which makes it more secured.

                                $sql = "INSERT INTO cvs (name, email, password) VALUES ('$name', '$email', '$hashed_password')"; // this adds the new email and password to the database.
                                $error = "Login Created successfully!   ";
                                $loginNow = "    press here to login!";
                            }
                        }

                        if (mysqli_query($conn, $sql)) {
                            //echo "New record created successfully";
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }
                    } else {
                        $error = "Passwords do not match";
                    }
                } else {
                    $error = "Emails do not match";
                }

                mysqli_close($conn);
            }
            ?> </div> <!-- register form -->
            <main class="Main-Panel">
                <div class="register-form">
                    <div class="flex">
                        <div class="Box1">
                            <div class="register-header">
                                <h1>Register</h1>
                            </div>
                            <div class="register-body">
                                <form action="Register.php" method="post">
                                    <div class="form-group"> <input type="text" name="name" id="name" class="control" placeholder="Name" required> </div>
                                    <div class="form-group"> <input type="email" name="email" id="email" class="form-control" placeholder="Email" required> </div>
                                    <div class="form-group"> <input type="email" name="confirm-email" id="confirm-email" class="form-control" placeholder="Confirm Email" required> </div>
                                    <div class="form-group"> <input type="password" name="password" id="password" class="form-control" placeholder="Password" required> </div>
                                    <div class="form-group"> <input type="password" name="confirm-password" id="confirm-password" class="form-control" placeholder="Confirm Password" required> </div>
                                    <div class="form-group"> <input type="submit" name="submit" id="submit" value="Register"> </div>
                                    <div class="form-group"> <a href="Home.php">Already have an account?</a> </div>
                                    <div class="error"> <label for="Errors" class="errorMsg"> <?php echo $error; ?> </label> <a href="Home.php"> <label for="Errors" class="errorMsg"> <?php echo $loginNow; ?> </label> </a> </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <script src="js/Nav.js"></script>
        </body>

</html>