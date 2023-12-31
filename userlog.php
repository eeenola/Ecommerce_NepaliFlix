<?php
if (isset($_POST['log'])) {
    include 'C:\xampp\htdocs\NepaliFlix\include\connect.php';
    $uname = $_POST['username'];
    $password = $_POST['password'];

    if (empty($uname) || empty($password)) {
        header("Location: userloginform.php?error=fields_are_empty");
        exit();
    } else {
        // Check if 'Email' is set in the $_POST array
        $email = isset($_POST['Email']) ? $_POST['Email'] : '';

        $query = "SELECT * FROM `users` WHERE Username = ? OR Email = ?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $query)) {
            header("Location: userloginform.php?error=prepared statement error");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $uname, $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $validatepass = password_verify($password, $row['Password']);
                if ($validatepass == false) {
                    header("Location: userloginform.php?error=Entered wrong information");
                    exit();
                } else {
                    session_start();

                    $_SESSION['uname'] = $row['Username'];
                    $_SESSION['user_id'] = $row['id'];
                    header("Location: home.php?action=logged_in");
                    exit();
                }
            }
        }
    }
} else {
    header("Location: userloginform.php?error=login first");
    exit();
}
?>
