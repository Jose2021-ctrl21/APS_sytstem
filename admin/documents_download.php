<?php
include 'includes/session.php';

// Get the file data from the database
$sql = "SELECT files, file_name, file_type FROM files WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $fileId);
$stmt->execute();
$fileData = $stmt->fetch(PDO::FETCH_ASSOC);

// Set the HTTP headers
header('Content-Type: ' . $fileData['file_type']);
header('Content-Disposition: attachment; filename="' . $fileData['file_name'] . '"');

// Output the file data
echo $fileData['file_data'];

