<?php
// Check if the deleteAllBtn button is clicked
if (isset($_POST['deleteAllBtn'])) {
  // Check if any checkboxes are checked
  if (!empty($_POST['checkedRows'])) {
    $placeholders = rtrim(str_repeat('?,', count($_POST['checkedRows'])), ',');
    $deleteStmt = $conn->prepare("DELETE FROM attendance WHERE id IN ($placeholders)");

    $deleteStmt->bind_param(str_repeat('s', count($_POST['checkedRows'])), ...$_POST['checkedRows']);

    if ($deleteStmt->execute()) {
      echo "<script>
        if (alert('Selected rows have been deleted successfully.')) {
          window.location.href = 'attendance.php';
        } else {
          // User canceled the deletion
        }
      </script>";
    } else {
      echo "<script>
        alert('Error deleting rows.');
        window.location.href = 'error.php';
      </script>";
    }
  }
}
?>