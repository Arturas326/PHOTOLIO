<?php
include 'db_connect.php';
include 'db_connect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $target_dir = "foto/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size (for example, limit to 5MB)
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file and write to db.txt
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO photos (name, description, path) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $photoName, $photoDescription, $target_file);

            // Set parameters and execute
            $photoName = $_POST['photo_name'];
            $photoDescription = $_POST['description'];
            $stmt->execute();
            $stmt->close();

            // Append data to db.txt
            $photoData = [
                'name' => $photoName,
                'description' => $photoDescription,
                'path' => $target_file
            ];
            $photoDataString = json_encode($photoData) . PHP_EOL;
            file_put_contents('db.txt', $photoDataString, FILE_APPEND);

            // Redirect to admin_dashboard.php
            header('Location: admin_dashboard.php');
            exit;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    $conn->close();
}
?>

<?php
    // Inside upload_photo.php after successful upload
    $target_dir = "foto/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $photoData = [
            'name' => $_POST['photo_name'],
            'description' => $_POST['description'],
            'path' => $target_file
        ];

        $photoDataString = json_encode($photoData) . "\n";
        file_put_contents('db.txt', $photoDataString, FILE_APPEND);

        // Redirect to admin_dashboard.php
        header('Location: admin_dashboard.php');
        exit;
    }
?>


