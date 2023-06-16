<?php 

session_start(); 

include "dbconn.php";

if (isset($_POST['username']) && isset($_POST['password'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $username = validate($_POST['username']);

    $password = validate($_POST['password']);

    if (empty($username)) {

        header("Location: admin_login.html?error=User Name is required");

        exit();

    }else if(empty($password)){

        header("Location:  admin_login.html?error=Password is required");

        exit();

    }else{

       echo $sql = "SELECT * FROM admin_login WHERE username='$username' AND password='$password'";
        $result = mysqli_query($db, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['username'] === $username && $row['password'] === $password) {

                echo "Logged in!";

                $_SESSION['username'] = $row['username'];

                $_SESSION['name'] = $row['name'];

                $_SESSION['email'] = $row['email'];

                header("Location: details.html");
                

                exit();

            }else{

               // header("Location: login.html?error=Incorect User name or password");
                echo "ERROR:
                      USER NAME AND PASSWORD DOESN'T MATCH
                      PLEASE CHECK AGAIN";
                exit();

            }

        }else{

           // header("Location:  login.html?error=Incorect User name or password");
               
           echo "ERROR:
                USER NAME AND PASSWORD DOESN'T MATCH
                PLEASE CHECK AGAIN";;
            exit();

        }

    }

}else{

    header("Location: admin_home.html");

    exit();

}

