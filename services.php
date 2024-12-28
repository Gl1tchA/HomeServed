<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/servicesstyle.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://js.stripe.com/v3/"></script>  
</head>
<body>
<?php
    session_start();
?>

      <main>
          <section class="hero">
            <header>
              <h1><img src="image/logo1.png" class="icon">HOMESERVED SERVICES</h1>
              <ul class="nav">
                  <li class="scroll-to-section"><a href="index.php" class="active">HOME</a></li>
                  <li class="scroll-to-section"><a style="color: #ff9800" href="services.php">SERVICES</a></li>
                  <li class="scroll-to-section"><a href="contacts.php">CONTACT</a></li>
                  <li class="scroll-to-section"><a href="aboutus.php">ABOUT US</a></li>
              </ul>

              <ul class="nav">
                          <?php if (isset($_SESSION['name'])): ?>
                              
                              <li class="scroll-to-section"><a href="#">HELLO, <?php echo htmlspecialchars($_SESSION['name']); ?></a></li>
                              <li class="scroll-to-section"><a href="api/logout.php">LOGOUT</a></li>
                          <?php else: ?>

                              <li class="scroll-to-section"><a href="signup.php">SIGN-UP</a></li>
                              <li class="scroll-to-section"><a href="login.php">LOGIN</a></li>
                          <?php endif; ?>
                      </ul>
              </ul>
            </header>
            <script src="./js/gen-effects.js"></script>
            <div class="hero-content main-content">
                <h2>Services that fit your needs</h2>
                <p>Your home, our service</p>
            </div>
        </section>

        <section class="main-content">
          <br>
          <h2 style="font-size:5rem; text-align:center;">Our Services</h2>
          <br>
        </section>

      <section class="services">
        <a href="#" class="service-item" style="background-image: url(image/service1.jpg);"  onclick="toggleAndFocus(event)">
            <div class="overlay">
                <h2>Cleaning Service</h2>
            </div>
        </a>
        <a href="#" class="service-item" style="background-image: url(image/service3.jpg);" onclick="toggleAndFocus(event)">
            <div class="overlay">
                <h2>Basic Electronics</h2>
            </div>
        </a>
        <a href="#" class="service-item half-width" style="background-image: url(./image/ree.jpg);" onclick="toggleAndFocus(event)">
            <div class="overlay">
                <h2>Plumbing</h2>
            </div>
        </a>
        <a href="#" class="service-item" style="background-image: url(./image/service4.jpg);" onclick="toggleAndFocus(event)">
            <div class="overlay">
                <h2>Childcare</h2>
            </div>
        </a>
        <a href="#" class="service-item" style="background-image: url(./image/service5.jpg);" onclick="toggleAndFocus(event)">
            <div class="overlay">
                <h2>Gardening</h2>
            </div>
        </a>
    </section>


    <div class="collapsible" id="hiddenSection">
      <img src="image/return.png" onclick="toggleAndFocus(event)" class="back-button" style="cursor: pointer">  
      <h1 class="form-title">What Service do you need?</h1>
      <div class="form-layout">
        <form id="payment-form" action="api/service_submit.php" method="POST" class="service-inquiry">
        <input type="hidden" name="session_name" value="<?php echo $_SESSION['name']; ?>">
          <label>
              Type of Service
            </label>
            <select name="service" id="services" required>
              <option value="" disabled selected>Select a service</option>
              <option value="Cleaning" data-price="500">General Cleaning</option>
              <option value="Electronics" data-price="2500">Electronics</option>
              <option value="Plumbing" data-price="1000">Plumbing</option>
              <option value="Childcare" data-price="2000">Nanny Services</option>
              <option value="Gardening" data-price="500">Gardening</option>
            </select>
            <input type="hidden" name="price" id="priceInput">
            <p id="price-display"></p>
            <label>
              Address
            </label>
            <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
            <div id="map"></div>
            <input type="text" id="address-input" name="address" placeholder="Type an address">           
            <label>
              Contact number
            </label>
            <input id="phone" type="tel" name="contact_num" required onblur="validatePhone()">
            <div id="phone-error"></div>
            <label>
              Email
            </label>
            <input id="email" type="email" name="email" required onblur="validateEmail()">
            <div id="email-error" class="error-message"></div>
            <label>Mode of Payment</label>
            <select name="mode" id="mode" required>
              <option value="" disabled selected>Select payment mode</option>
              <option value="Cash">Cash</option>
              <option value="Credit">Credit Card</option>
            </select>
            <div class="form-row">
                    <label for="card-element">Enter Credit or Debit Card</label>
                    <br>
                    <div id="card-element">
                    <!-- Stripe Elements will inject the card input here -->
                    </div>
                    <!-- Display error message if the card information is invalid -->
                    <div id="card-errors" role="alert"></div>
            </div>

            <input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>">


            <br>                
             <br>               
            <input id="submit-button" type="submit" value="Submit" />
            <br>            
            <br>
            <i class="disclaimer">****The Cost of each service is the price shown but may increase by the same amount depending on the over time****</i>
        </form>                    
      </div>
    </div>
    <script>
      // Output the session value as a JavaScript variable
      const userLoggedIn = <?php echo isset($_SESSION['name']) && !empty($_SESSION['name']) ? 'true' : 'false'; ?>;
    
      function toggleAndFocus(event) {
        event.preventDefault(); // Prevent default anchor behavior
    
        if (userLoggedIn) {
          // Proceed with the normal toggle behavior if user is logged in
          const section = document.getElementById('hiddenSection');
          const isHidden = section.style.display === 'none' || section.style.display === '';
          section.style.display = isHidden ? 'block' : 'none';
          
          // Focus on the section if it is being shown
          if (isHidden) {
            section.scrollIntoView({ behavior: 'smooth' });
          }
        } else {
          // Redirect to login.html if the user is not logged in
          window.location.href = 'login.php';
        }
      }
    </script>
        </main>




      <footer class="footer">
        <div class="footer-content">
          <div class="footer-section about">
            <h3>About Us</h3>
            <p>All your home chores, repairs and fixes at the click of a button. We serve your home service needs!</p>
          </div>
          <div class="footer-section links">
            <h3>Quick Links</h3>
            <ul class="h-link">
              <li><a href="index.php">Home</a></li>
              <li><a href="services.php">Services</a></li>
              <li><a href="aboutus.php">About</a></li>
              <li><a href="contacts.php">Contact</a></li>
            </ul>
          </div>
          <div class="footer-section social">
            <h3>Follow Us</h3>
            <a href="https://www.facebook.com/profile.php?id=61570736364399"><img src="image/facebook.png"></a>
            <a href="https://x.com/HomeServedOffcl"><img class="twitter" src="image/twitter.png"></a>
            <a href="https://www.instagram.com/homeserved67/"><img src="image/instagram.png"></i></a>
            <a href="https://www.youtube.com/@HomeServed"><img src="image/youtube.png"></i></a>
          </div>
        </div>
      
        <div class="footer-bottom">
          <p>&copy; 2024 HomeServed Services. All rights reserved.</p>
        </div>
      </footer>
      <script src="js/validator.js"></script>
      <script>
        const serviceSelect = document.getElementById('services');
        const priceDisplay = document.getElementById('price-display');
        const priceInput = document.getElementById('priceInput');

        serviceSelect.addEventListener('change', () => {
          const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
          const price = selectedOption.getAttribute('data-price');
          priceDisplay.textContent = price ? `Price: $${price}` : '';
          priceInput.value = price; // Update the hidden input field
        });
      </script>
      <script src="api/maps.js"></script>
      <script src="js/pay.js"></script>
      <script>
        // Get the payment mode select element
        const modeSelect = document.getElementById('mode');
        
        // Get the form-row div (the one with card input)
        const formRow = document.querySelector('.form-row');
        
        // Listen for changes to the payment mode select
        modeSelect.addEventListener('change', function() {
          if (modeSelect.value === 'Credit') {
            formRow.style.display = 'block'; // Show card input when Credit is selected
          } else {
            formRow.style.display = 'none'; // Hide card input when Cash is selected
          }
        });

        // Trigger the initial state based on the default selection
        if (modeSelect.value === 'Credit') {
          formRow.style.display = 'block'; // Show card input if Credit is pre-selected
        }
      </script>

</body>

</html>
