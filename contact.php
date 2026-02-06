<?php
session_start();


if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit;
}

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");


if (isset($_SESSION['role']) && ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'staff')) {
    header("Location: dashboard.php");
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
     <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/footer.css">                                                
     <style>
    :root {
      --primary-color: #2ecc71;
      --secondary-color: #27ae60;
      --text-color: #333;
      --light-bg: #f8f9fa;
      --card-shadow: 0 4px 6px rgba(0,0,0,0.1);
      --transition: all 0.3s ease;
    }
    
                                                                                                                                                                                                                                                                                                                           
    
    body {
      color: var(--text-color);
      background-color: #f5f7fa;
      line-height: 1.6;
    }
    
    .container-fluid {
     width: 90%;
     position: relative;
     top: 50px;
      padding: 2rem;
    }
    
    .page-title {
      text-align: center;
      margin-bottom: 2rem;
      color: var(--text-color);
      font-size: 2.5rem;
      font-weight: 600;
    }
    
    .contact-wrapper {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 2rem;
    }
    
    .contact-info {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }
    
    .contact-card {
      background-color: white;
      border-radius: 10px;
      padding: 1.5rem;
      margin-bottom: 3rem;
      box-shadow: var(--card-shadow);
      transition: var(--transition);
    }
    
    .contact-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 15px rgba(0,0,0,0.1);
    }
    
    .card-header {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin-bottom: 1rem;
      border-bottom: 1px solid #eee;
      padding-bottom: 0.8rem;
    }
    
    .card-icon {
      width: 40px;
      height: 40px;
      background-color: var(--primary-color);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 1.2rem;
    }
    
    .card-title {
      font-size: 1.5rem;
      font-weight: 600;
      color: var(--text-color);
    }
    
    .card-content {
      padding: 0.5rem 0;
    }
    
    .location-item {
      margin-bottom: 1rem;
    }
    
    .city-name {
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    
    .city-name .dot {
      width: 12px;
      height: 12px;
      background-color: var(--primary-color);
      border-radius: 50%;
      display: inline-block;
    }
    
    .address {
      margin: 0.3rem 0 0.5rem 1.5rem;
      color: #555;
    }
    
    .map-link {
      margin-left: 1.5rem;
      color: var(--primary-color);
      text-decoration: none;
      font-size: 0.9rem;
      display: inline-flex;
      align-items: center;
      gap: 0.2rem;
    }
    
    .map-link:hover {
      color: var(--secondary-color);
      text-decoration: underline;
    }
    
    .contact-link {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      text-decoration: none;
      color: #555;
      margin: 0.5rem 0;
      transition: var(--transition);
    }
    
    .contact-link:hover {
      color: var(--primary-color);
    }
    
    .contact-form {
      background-color: white;
      border-radius: 10px;
      padding: 2rem;
      height: 70%;
      box-shadow: var(--card-shadow);
    }
    
    .form-title {
      font-size: 1.8rem;
      margin-bottom: 1rem;
      color: var(--text-color);
    }
    
    .form-description {
      color: #666;
      margin-bottom: 1.5rem;
    }
    
    .form-group {
      margin-bottom: 1.5rem;
    }
    
    .form-label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
    }
    
    .form-control {
      width: 100%;
      padding: 0.8rem 1rem;
      border: 1px solid #ddd;
      border-radius: 5px;
      font-size: 1rem;
      transition: var(--transition);
    }
    
    .form-control:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(46, 204, 113, 0.2);
    }
    
    textarea.form-control {
      min-height: 150px;
      resize: vertical;
    }
    
    .btn_1 {
      background-color: var(--primary-color);
      color: white;
      border: none;
      padding: 0.8rem 1.5rem;
      border-radius: 5px;
      font-size: 1rem;
      font-weight: 500;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      transition: var(--transition);
    }
    
    .btn_1:hover {
      background-color: var(--secondary-color);
      transform: translateY(-2px);
    }
    
    .powered-by {
      text-align: right;
      margin-top: 1rem;
      font-size: 0.9rem;
      color: #888;
    }
    
    .tally-logo {
      height: 20px;
      vertical-align: middle;
    }
    
    @media (max-width: 768px) {
      .contact-wrapper {
        grid-template-columns: 1fr;
      }
      
      .page-title {
        font-size: 2rem;
      }
    }
  </style>
</head>

<body>
<?php include 'Includes/header.php';?>



<div class="container-fluid">
    <h1 class="page-title">Contact Us</h1>
    
        <div class="contact-card" data-aos="fade-up">
        <div class="contact-wrapper" >
      <div class="contact-info">
        <div class="contact-card">
          <div class="card-header">
            <div class="card-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                <circle cx="12" cy="10" r="3"></circle>
              </svg>
            </div>
            <h2 class="card-title">Free Pick Up Points</h2>
          </div>
          
          <div class="card-content">
            <div class="location-item">
              <div class="city-name">
                <span class="dot"></span> Dipolog City
              </div>
              <div class="address">2362 St, Dipolog City</div>
            </div>
            
            <div class="location-item">
              <div class="city-name">
                <span class="dot"></span> Ozamis City
              </div>
              <div class="address">29 St, Ozamis City</div>
             
            </div>
            
            <div class="location-item">
              <div class="city-name">
                <span class="dot"></span> Pagadian City
              </div>
              <div class="address">G3P8+J5Q, G.L. Pagadian</div>
             
            </div>
          </div>
        </div>
        
        <div class="contact-card">
          <div class="card-header">
            <div class="card-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                <polyline points="22,6 12,13 2,6"></polyline>
              </svg>
            </div>
            <h2 class="card-title">Mail Us</h2>
          </div>
          <div class="card-content">
            <a href="mailto:support@motorentmanila.com" class="contact-link">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                <polyline points="22,6 12,13 2,6"></polyline>
              </svg>
              support@RMRental.com
            </a>
          </div>
        </div>
        
        <div class="contact-card">
          <div class="card-header">
            <div class="card-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="2" y1="12" x2="22" y2="12"></line>
                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
              </svg>
            </div>
            <h2 class="card-title">Socials</h2>
          </div>
          <div class="card-content">
            <a href="https://fb.com/motorentmanila" target="_blank" class="contact-link">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
              </svg>
              fb.com/RMRental
            </a>
          </div>
        </div>
        
        <div class="contact-card">
          <div class="card-header">
            <div class="card-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
              </svg>
            </div>
            <h2 class="card-title">Telephone</h2>
          </div>
          <div class="card-content">
            <a href="tel:+639756988612" class="contact-link">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
              </svg>
              +63975 698 0000
            </a>
          </div>
        </div>
        
        <div class="contact-card">
          <div class="card-header">
            <div class="card-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
              </svg>
            </div>
            <h2 class="card-title">Chat Us</h2>
          </div>
          <div class="card-content">
            <a href="https://m.me/motorentmanila" target="_blank" class="contact-link">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
              </svg>
              Messenger: m.me/RMRental
            </a>
            
            <a href="https://wa.me/639756988612" target="_blank" class="contact-link">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
              </svg>
              WhatsApp: wa.me/63975698000
            </a>
            
            <a href="viber://chat?number=%2B639756988612" class="contact-link mb-5">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
              </svg>
              Viber: +63975698000
            </a>
          </div>
        </div>
      </div>
      <?php
$email = $_SESSION['email'];
  
   include 'Includes/db.php';
   
    $sql = "SELECT * FROM user WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
   
    $fname = $row['fname'];
    $lname = $row['lname'];
    $email = $row['email'];
    $phone = $row['phoneNum'];
    
} else {
    echo "Profile not found.";
}
?>
      
      <div class="contact-form">
        <h2 class="form-title">Contact Form</h2>
        
        <p class="form-description">We value your feedback! Please share your thoughts on how we can enhance your experience. Kindly note, this form is not intended for reservation requests.</p>
        <form id="contactForm" action="Includes/submit_form.php" method="POST">
  <div class="form-group">
    <label class="form-label" for="message">Message *</label>
    <textarea class="form-control" id="message" name="message" required></textarea>
  </div>

  <div class="form-group">
    <label class="form-label" for="fname">First Name</label>
    <input type="text" class="form-control" id="fname" name="first_name" required value="<?php echo htmlspecialchars($fname); ?>">
  </div>

  <div class="form-group">
    <label class="form-label" for="lname">Last Name</label>
    <input type="text" class="form-control" id="lname" name="last_name" required value="<?php echo htmlspecialchars($lname); ?>">
  </div>

  <div class="form-group">
    <label class="form-label" for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" required value="<?php echo htmlspecialchars($email); ?>">
  </div>

  <div class="form-group">
    <label class="form-label" for="phone">Phone number</label>
    <input type="tel" class="form-control" id="phone" name="phone" required value="<?php echo htmlspecialchars($phoneNum); ?>">
  </div>

  <button type="submit" class="btn btn_1">Submit</button>
</form>

       
      </div>
    </div>
 

    </div>



    </div>



    <?php include "Includes/footer.php";?>




   

      <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="Js/script.js"></script>
   
</body>
</html>