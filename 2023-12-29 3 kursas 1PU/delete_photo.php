<?php
include 'db_connect.php';

if(isset($_POST['photo_id'])) {
    $photoId = $_POST['photo_id'];

    // Retrieve the file path from the database
    $query = $conn->prepare("SELECT path FROM photos WHERE id = ?");
    $query->bind_param("i", $photoId);
    $query->execute();
    $result = $query->get_result();
    if($row = $result->fetch_assoc()) {
        $filePath = $row['path'];

        // Delete the file
        if(unlink($filePath)) {
            // File deleted successfully, now delete the database record
            $deleteQuery = $conn->prepare("DELETE FROM photos WHERE id = ?");
            $deleteQuery->bind_param("i", $photoId);
            $deleteQuery->execute();
        }
    }
    $conn->close();
    header('Location: admin_dashboard.php'); // Redirect back to the admin dashboard
}
?>
