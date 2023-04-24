<!DOCTYPE html>
<html>
<head>
    <title>Template Generator</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Social Media and Web Site Creator</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get template type and name from the form data
            $templateType = $_POST["templateType"];
            $templateName = $_POST["templateName"];

            // Generate the template based on the template type
            switch ($templateType) {
                case "landing":
                    // Generate code for landing page template
                    $templateCode = "
                    <!DOCTYPE html><html><head><title>Landing Page Template</title>
            <!-- Include Bootstrap CSS -->
            <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
                <!-- Include custom CSS for parallax effect -->
                <style>
                .parallax {
                        /* The image used */
                        background-image: url('hero.jpg');
                       /* Set a specific height */
                      height: 500px;
            /* Create the parallax scrolling effect */
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>
<body>
    <!-- Hero section with image and offer text -->
    <section class='parallax'>
        <div class='container text-center text-white'>
            <h1 class='display-4'>Welcome to Our Website</h1>
            <p class='lead'>Get the best deals and discounts for your next purchase!</p>
        </div>
    </section>

    <!-- Call-to-action (CTA) section with parallax effect -->
    <section class='bg-light py-5'>
        <div class='container text-center'>
            <h2 class='mb-4'>Shop Now and Save</h2>
            <p class='lead'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc id pulvinar tortor. Vivamus ullamcorper interdum iaculis.</p>
            <a href='#' class='btn btn-primary'>Shop Now</a>
        </div>
    </section>

    <!-- Contact form section -->
    <section class='bg-light py-5'>
        <div class='container'>
            <h2 class='text-center mb-4'>Contact Us</h2>
            <form>
                <div class='form-row'>
                    <div class='form-group col-md-6'>
                        <label for='name'>Name</label>
                        <input type='text' class='form-control' id='name' placeholder='Your Name'>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='email'>Email</label>
                        <input type='email' class='form-control' id='email' placeholder='Your Email'>
                    </div>
                </div>
                <div class='form-group'>
                    <label for='message'>Message</label>
                    <textarea class='form-control' id='message' rows='4' placeholder='Your Message'></textarea>
                </div>
                <button type='submit' class='btn btn-primary'>Send Message</button>
            </form>
        </div>
    </section>

    <!-- Footer section -->
    <footer class='bg-dark text-white text-center py-3'>
        <p>&copy; 2023 Your Company. All rights reserved.</p>
    </footer>

    <!-- Include Bootstrap and jQuery JS -->
    <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'></script>
</body>
</html>";
                    break;
                case "portfolio":
                    // Generate code for portfolio site template
                    $templateCode = "<!DOCTYPE html>
<html>
<head>
    <title>Facebook Ad Template</title>
    <style>
        /* Container for the ad */
        .ad-container {
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #f8f8f8;
            font-family: Arial, sans-serif;
        }

        /* Ad image */
        .ad-image {
            width: 100%;
            height: 200px;
            background-image: url('https://placekitten.com/300/200'); /* Replace with your ad image URL */
            background-size: cover;
            background-position: center;
        }

        /* Ad title */
        .ad-title {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
        }

        /* Ad description */
        .ad-description {
            font-size: 14px;
            color: #777;
            margin-top: 5px;
        }

        /* Contact us button */
        .contact-us-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #1877F2; /* Facebook blue color */
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
        }

        /* Contact us button hover effect */
        .contact-us-button:hover {
            background-color: #1265CB; /* Darker shade of Facebook blue color on hover */
        }
    </style>
</head>
<body>
    <div class='ad-container'>
        <div class='ad-image'></div>
        <div class='ad-title'>Facebook Ad Title</div>
        <div class='ad-description'>This is a description of the Facebook ad.</div>
        <a href='mailto:contact@example.com' class='contact-us-button'>Contact Us</a>
    </div>
</body>
</html>
";
                    break; 
                case "wordpress":
                    // Generate code for WordPress template
                    $templateCode = "<!DOCTYPE html>
<html>
<head>
    <title>Mailchimp Campaign Template</title>
    <style>
        /* Container for the subscription form */
        .subscription-form-container {
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #fff;
            font-family: Arial, sans-serif;
        }

        /* Subscription form title */
        .subscription-form-title {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
        }

        /* Subscription form description */
        .subscription-form-description {
            font-size: 14px;
            color: #777;
            margin-top: 5px;
        }

        /* Subscription form input field */
        .subscription-form-input {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        /* Subscription form submit button */
        .subscription-form-submit {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background-color: #405DE6; /* Mailchimp blue color */
            color: #fff;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
        }

        /* Subscription form submit button hover effect */
        .subscription-form-submit:hover {
            background-color: #3367D6; /* Darker shade of Mailchimp blue color on hover */
        }

        /* Unsubscribe link */
        .unsubscribe-link {
            font-size: 12px;
            color: #777;
            margin-top: 10px;
            text-align: center;
        }

        /* Unsubscribe link hover effect */
        .unsubscribe-link:hover {
            color: #405DE6; /* Mailchimp blue color on hover */
        }

        /* 'Sorry to see you go' message */
        .sorry-message {
            font-size: 14px;
            color: #777;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class='subscription-form-container'>
        <div class='subscription-form-title'>Subscribe to Our Mailing List</div>
        <div class='subscription-form-description'>Stay up-to-date with our latest news and promotions.</div>
        <form action='https://example.us5.list-manage.com/subscribe/post' method='POST'>
            <input type='hidden' name='u' value='YOUR_MAILCHIMP_LIST_ID'>
            <input type='hidden' name='id' value='YOUR_MAILCHIMP_LIST_ID'>
            <input type='email' name='MERGE0' class='subscription-form-input' placeholder='Email Address' required>
            <input type='submit' value='Subscribe' class='subscription-form-submit'>
        </form>
        <div class='unsubscribe-link'>To unsubscribe, <a href='https://example.us5.list-manage.com/unsubscribe' target='_blank'>click here</a></div>
        <div class='sorry-message'>Sorry to see you go!</div>
    </div>
</body>
</html>
";
                    break;
                case "ecommerce":
                    // Generate code for e-commerce template
                    $templateCode = "<!DOCTYPE html>
<html>
<head>
    <title>E-commerce Template Site</title>
    <!-- Include Bootstrap CSS -->
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
    <!-- Include custom CSS -->
    <style>
        /* Custom CSS styles go here */
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class='navbar navbar-expand-lg navbar-light bg-light'>
        <a class='navbar-brand' href='#'>Your Brand</a>
        <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span>
        </button>
        <div class='collapse navbar-collapse' id='navbarNav'>
            <ul class='navbar-nav ml-auto'>
                <li class='nav-item active'>
                    <a class='nav-link' href='#'>Home <span class='sr-only'>(current)</span></a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='#'>Shop</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='#'>Cart</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='#'>Contact Us</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Hero section with search bar -->
    <section class='hero bg-light py-5'>
        <div class='container text-center'>
            <h1 class='display-4'>Welcome to Your E-commerce Store</h1>
            <p class='lead'>Find the Best Deals for You</p>
            <form class='mt-4'>
                <div class='form-row justify-content-center'>
                    <div class='form-group col-md-6'>
                        <input type='text' class='form-control' placeholder='Search for products...'>
                    </div>
                    <div class='form-group col-md-2'>
                        <button type='submit' class='btn btn-primary'>Search</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Featured Products section -->
    <section class='bg-white py-5'>
        <div class='container'>
            <h2 class='text-center mb-4'>Featured Products</h2>
            <div class='row'>
                <div class='col-md-4'>
                    <div class='card'>
                        <img src='product1.jpg' class='card-img-top' alt='Product 1'>
                        <div class='card-body'>
                            <h5 class='card-title'>Product 1</h5>
                            <p class='card-text'>Product 1 Description</p>
                            <a href='#' class='btn btn-primary'>Add to Cart</a>
                        </div>
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class='card'>
                        <img src='product2.jpg' class='card-img-top' alt='Product 2'>
                        <div class='card-body'>
                            <h5 class='card-title'>Product 2</h5>
                            <p class='card-text'>Product 2 Description</p>
                            <a href='#' class='btn btn-primary'>Add to Cart</a>
                        </div>
                    </div>
                </div>
                <div class='col-md-4'>
<div class='card'>
<img src='product3.jpg' class='card-img-top' alt='Product 3'>
<div class='card-body'>
<h5 class='card-title'>Product 3</h5>
<p class='card-text'>Product 3 Description</p>
<a href='#' class='btn btn-primary'>Add to Cart</a>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- Call to Action section -->
<section class='cta bg-primary text-white text-center py-5'>
    <div class='container'>
        <h2 class='display-4'>Shop Now and Get the Best Deals!</h2>
        <a href='#' class='btn btn-light btn-lg mt-3'>Shop Now</a>
    </div>
</section>

<!-- Contact Us section -->
<section class='contact bg-light py-5'>
    <div class='container'>
        <div class='row'>
            <div class='col-md-6'>
                <h2>Contact Us</h2>
                <p>Please feel free to contact us with any questions or concerns. We are here to help!</p>
                <ul class='list-unstyled'>
                    <li><strong>Email:</strong> contact@example.com</li>
                    <li><strong>Phone:</strong> (123) 456-7890</li>
                </ul>
            </div>
            <div class='col-md-6'>
                <h2>Send Us a Message</h2>
                <form>
                    <div class='form-row'>
                        <div class='form-group col-md-6'>
                            <label for='name'>Name</label>
                            <input type='text' class='form-control' id='name' placeholder='Name'>
                        </div>
                        <div class='form-group col-md-6'>
                            <label for='email'>Email</label>
                            <input type='email' class='form-control' id='email' placeholder='Email'>
                        </div>
                    </div>
                    <div class='form-group'>
                        <label for='message'>Message</label>
                        <textarea class='form-control' id='message' rows='4' placeholder='Message'></textarea>
                    </div>
                    <button type='submit' class='btn btn-primary'>Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class='bg-dark text-white text-center py-3'>
    <div class='container'>
        <p>&copy; 2023 Your E-commerce Store. All rights reserved.</p>
    </div>
</footer>

<!-- Include Bootstrap JS and any other custom JS files -->
<script src='https://code.jquery.com/jquery-3.5.1.slim.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'></script>
</body>
</html>";
                    break;
                default:
                    // Error handling for invalid template type
                    die("Invalid template type");
            }
            
            // Display the generated template as a modal popup
            echo '<div class="modal" tabindex="-1" role="dialog" id="templateModal">';
            echo '<div class="modal-dialog" role="document">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title">Generated Template</h5>';
            echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            echo '<span aria-hidden="true">&times;</span>';
            echo '</button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo $templateCode; // Display the generated template code
            echo '</div>';
            echo '<div class="modal-footer">';
            echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
            echo '<a href="' . $templateName . '.html" class="btn btn-primary">Save Template</a>'; // Save template link
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            
            echo '<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>'; // Include jQuery
            echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>'; // Include Bootstrap JS
            echo '<script>
                    // Show the modal popup
                    $(document).ready(function(){
                        $("#templateModal").modal("show");
                    });
                  </script>';
        }
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-group">
                <label for="templateType">Select Template Type:</label>
                <select class="form-control" id="templateType" name="templateType">
                    <option value="landing">Landing Page</option>
                    <option value="portfolio">Facebook Add</option>
                    <option value="wordpress">MailChimp Template</option>
                    <option value="ecommerce">E-commerceTemplate</option>
</select>
</div>
<div class="form-group">
<label for="templateName">Template Name:</label>
<input type="text" class="form-control" id="templateName" name="templateName">
</div>
<div class="form-group">
<input type="submit" class="btn btn-primary" value="Generate Template">
</div>
</form>
</div>
<!-- Include Bootstrap and jQuery JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
