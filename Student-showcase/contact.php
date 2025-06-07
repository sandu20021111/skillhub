<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // DB connection
    $conn = new mysqli("localhost", "root", "", "student_showcase");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        $success = "Message sent successfully!";
    } else {
        $error = "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Contact Us</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" />
  <link rel="stylesheet" type="text/css" href="assets/css/contact.css">
</head>
<body>
  <?php include 'includes/header.php'; ?>
  <section class="contact">
    <div class="content">
      <h2>Contact Us</h2>
      <p>Any question or remark? Just write us a message!</p>
      <?php if (!empty($success)): ?>
        <p style="color: #0ef; font-weight: bold;"><?php echo $success; ?></p>
      <?php elseif (!empty($error)): ?>
        <p style="color: red; font-weight: bold;"><?php echo $error; ?></p>
      <?php endif; ?>
    </div>

    <div class="container">
      <div class="contactInfo">
        <div class="box">
          <div class="Icon"><i class="fa-solid fa-location-dot"></i></div>
          <div class="text">
            <h3>Address</h3>
            <p>ABC Company (Pvt) LTD,<br>Main Road,<br>Colombo 7</p>
          </div>
        </div>
        <div class="box">
          <div class="Icon"><i class="fa-solid fa-phone"></i></div>
          <div class="text">
            <h3>Phone</h3>
            <p>011-2678943</p>
          </div>
        </div>
        <div class="box">
          <div class="Icon"><i class="fa-solid fa-envelope"></i></div>
          <div class="text">
            <h3>Email</h3>
            <p>ABC34577@gmail.com</p>
          </div>
        </div>
        <h2 class="txt">Connect with us</h2>
        <ul class="sci">
          <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
          <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
          <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
          <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
        </ul>
      </div>

      <div class="contactForm">
        <form method="POST" action="">
          <h2>Send Message</h2>
          <div class="inputBox">
            <input type="text" name="name" required />
            <span>Full Name</span>
          </div>
          <div class="inputBox">
            <input type="email" name="email" required />
            <span>Email</span>
          </div>
          <div class="inputBox">
            <textarea name="message" required></textarea>
            <span>Type your Message...</span>
          </div>
          <div class="inputBox">
            <input type="submit" value="Send" />
          </div>
        </form>
      </div>
    </div>
  </section>
</body>
</html>
