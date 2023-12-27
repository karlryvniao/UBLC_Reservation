<?php
include '../../config/connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Retrieve JSON data
  $jsonData = json_decode($_POST['data'], true);

  // Extract data
  $userId = $jsonData['hidden_id'];
  $name = $jsonData['name'];
  $username = $jsonData['username'];
  $password = $jsonData['password']; // Note: Implement proper password hashing
  $role = $jsonData['role'];

  // Update user data in the database
  $sql = "UPDATE users SET name = :name, username = :username, password = :password, role = :role WHERE user_id = :userId";
  $stmt = $con->prepare($sql);
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':username', $username);
  $stmt->bindParam(':password', $password); // Note: Hash the password before binding
  $stmt->bindParam(':role', $role);
  $stmt->bindParam(':userId', $userId);

  try {
    $stmt->execute();
    echo json_encode(['success' => true, 'message' => 'User updated successfully']);
  } catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error updating user: ' . $e->getMessage()]);
  }
}
?>

