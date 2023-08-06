<?php

    if (isset($_POST['login'])) {

        $con = mysqli_connect('localhost', 'root', '', 'login_form');

        // Check connection
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Retrieve form data
        $uEmail = $_POST['userEmail'];
        $uPassword = $_POST['userPassword'];

        // select table and check user is available in database 

        $sql = "SELECT * FROM login_form WHERE email = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "s", $uEmail);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);

        // Check if a user with the provided email exists
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $storedPassword = $row['userPassword'];

            // Verify the provided password with the stored password
            if (password_verify($uPassword, $storedPassword)) {
                // Password is correct, redirect to the next page (replace 'next-page.php' with your desired page)
                header("Location: next-page.php");
                exit();
            } else {
                // Password is incorrect
                echo "Invalid credentials. Please try again.";
            }
        } else {
            // User with the provided email does not exist
            echo "User account not found. Please try again.";
        }

        // Close the connection
        mysqli_close($con);
    }
    

?>

