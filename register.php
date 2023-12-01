<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["nama"]);
    $email = htmlspecialchars($_POST["email"]);
    $nim = htmlspecialchars($_POST["nim"]);
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);
    $confirm_password = htmlspecialchars($_POST["confirm_password"]);
    $story = htmlspecialchars($_POST["story"]);

    if ($password !== $confirm_password) {
        $error = "Password dan konfirmasi password tidak cocok";
    } else {

        $servername = "localhost";
        $username_db = "root";
        $password_db = "";
        $dbname = "uas_diani";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username_db, $password_db);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec("ALTER TABLE users AUTO_INCREMENT = 1");

            $stmt = $conn->prepare("INSERT INTO users (nama, email, nim, username, password, story) VALUES (:nama, :email, :nim, :username, :password, :story)");
            $stmt->bindParam(':nama', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':nim', $nim);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':story', $story);
            $stmt->execute();

            header("Location: index.php");
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $conn = null;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Register</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: linear-gradient( 109.6deg,  rgba(61,245,167,1) 11.2%, rgba(9,111,224,1) 91.1% );            
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .register-box {
            background-color: white;
            padding: 100px;
            border-radius: 24px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row min-vh-100 d-flex align-items-center justify-content-center">
            <div class="register-box">
                <h2 class="text-center mb-12">Register</h2>
                <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
                <form action="register.php" method="post">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="nama">Name:</label>
                                <input type="text" id="nama" name="nama" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="nim">NIM:</label>
                                <input type="text" id="nim" name="nim" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="username">Username:</label>
                                <input type="text" id="username" name="username" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="confirm_password">Re-type Password:</label>
                                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Ceritakan singkat tentang kamu</label>
                        <textarea class="form-control" id="story" name="story" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
