<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "uas_diani";

$conn = new mysqli($servername, $username, $password, $database);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("Location: home.php");
        exit;
    }
    $id = $_GET["id"];

    $sql = "SELECT * FROM users WHERE id=$id";
    $result = $conn->query($sql);

    if (!$result) {
        die("Error retrieving data: " . $conn->error);
    }

    $row = $result->fetch_assoc();

    $nama = $row["nama"];
    $email = $row["email"];
    $nim = $row["nim"];
    $username = $row["username"];
    $password = $row["password"];
    $story = $row["story"];
} else {
    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $nim = $_POST["nim"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $story = $_POST["story"];

    do {
        if (empty($id) || empty($nama) || empty($email) || empty($nim) || empty($username) || empty($password) || empty($story)) {
            $error_message = "All the fields are required";
            break;
        }

        $sql = "UPDATE users SET nama='$nama', email='$email', nim='$nim', username='$username', password='$password', story='$story' WHERE id='$id'";

        $result = $conn->query($sql);

        if (!$result) {
            die("Error updating data: " . $conn->error);
        }

        header('Location: home.php');
        exit;
    } while (true);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Edit</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        
        .rounded-box {
        border-radius: 24px;
        overflow: hidden;
        }

        .shadow {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container rounded-box shadow">
        <div class="row mb-4 mt-4 d-flex align-items-center justify-content-center">
        <h2 class="text-center">Edit</h2>
            <div class="register-box ml-4 mr-4">
                <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
                <form method="post">
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?php echo $id?>">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="nama">Name:</label>
                                <input type="text" id="nama" name="nama" class="form-control" value="<?php echo $nama?>">
                            </div>
                            <div class="col-md-6">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" class="form-control" value="<?php echo $email?>">
                            </div>
                            <div class="col-md-6">
                                <label for="nim">NIM:</label>
                                <input type="text" id="nim" name="nim" class="form-control" value="<?php echo $nim?>">
                            </div>
                            <div class="col-md-6">
                                <label for="username">Username:</label>
                                <input type="text" id="username" name="username" class="form-control" value="<?php echo $username?>">
                            </div>
                            <div class="col-md-6">
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" class="form-control" value="<?php echo $password?>">
                            </div>                            
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Ceritakan singkat tentang kamu</label>
                        <textarea class="form-control" id="story" name="story" rows="3"><?php echo $story?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                    <button type="button" class="btn btn-danger btn-block" onclick="window.location.href='home.php'">Cancel</button>
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