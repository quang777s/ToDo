<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<style>
/* Full-width input fields */
input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

/* Extra styles for the cancel button */
.cancelbtn {
    padding: 14px 20px;
    background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn,.signupbtn {
    float: left;
    width: 50%;
}

/* Add padding to container elements */
.container {
    padding: 16px;
}

/* Clear floats */
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
    .cancelbtn, .signupbtn {
       width: 100%;
    }
}
</style>
<body>

<h2>Signup Form</h2>

<form id="signup" action="/action_page.php" style="border:1px solid #ccc">
  <div class="container">
    <label><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <!-- <label><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="password-repeat" required> -->
    <!-- <input type="checkbox" checked="checked"> Remember me -->

    <div class="clearfix">
    <a href="<?php echo site_url(); ?>">
        <button type="button" class="cancelbtn">Cancel</button>
    </a>
      
      <button id="signupbtn" type="button" class="signupbtn">Sign Up</button>
    </div>
  </div>
</form>

</body>
</html>

<script type="text/javascript">
$( document ).ready(function() {
    $('#signupbtn').on('click', function(){
        var input = {'email': $('input[name="email"]').val(), 'password': $('input[name="password"]').val()};
        $.post( "http://localhost:8001/index.php/api/user/register", input, function(data) {
            if (data.status != false) {
                window.location.replace("http://localhost:8000/login");
            }
        }, 'json');
        
    })
});
</script>