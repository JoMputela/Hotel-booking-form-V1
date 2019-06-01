<?php
// Start the session
session_start();


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Hotel Booking Form</title>


    <style type="text/css">
      

body{
    background-image: url(4.jpg);
    background-size: 100%;
}



    </style>
  </head>
  <body>


<center>
<br>
<h1>Hotel Booking Form</h1>
<br>
<hr>


<?php

        $sql = "CREATE TABLE IF NOT EXISTS hotelbooking (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	 	title VARCHAR(50),
	    fname VARCHAR(50),
	    lname VARCHAR(50),
	    phone VARCHAR(50),
	    Email VARCHAR(50),
	    dayin VARCHAR(50),
	    dayout VARCHAR(50),
	    hotels VARCHAR(30),
	    msg VARCHAR(70)
	    )";
    require_once 'connect1.php';
    $conn->query($sql);
    echo $conn->error;

?>


<?php
            
 	

$confirm = (isset($_POST['confirm'] ) ) ? $_POST['confirm'] : '';

if(!isset($confirm)) {


    $title  = $_SESSION['title'];
    $fname  = $_SESSION['fname'];
    $lname  = $_SESSION['lname'];
    $phone  = $_SESSION['phone'];
    $Email  = $_SESSION['Email'];
    $dayin  = $_SESSION['dayin'];
    $dayout = $_SESSION['dayout'];
    $hotels = $_SESSION['hotels'];
    $msg    = $_SESSION['msg'];



$sql = "INSERT INTO hotelbooking (title, fname, lname, phone, Email, dayin, dayout, hotels, msg)
    VALUES('$title', '$fname', '$lname', '$phone', '$Email', '$dayin', '$dayout', '$hotels', '$msg')";


if ($conn->query($sql) === TRUE) {
    echo "Your Booking has been Confirmed!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

}







?>



<!-- the first display to show details entered into the form but not seding to the database/mysql yet -->
<?php

    if(isset($_POST['submit'])){
       
    $_SESSION['title']= $_POST['title'];
    $_SESSION['fname']= $_POST['fname'];
    $_SESSION['lname']= $_POST['lname'];
    $_SESSION['phone']= $_POST['phone'];
    $_SESSION['Email']= $_POST['Email'];
    $_SESSION['dayin']= $_POST['dayin'];
    $_SESSION['dayout']= $_POST['dayout'];
    $_SESSION['hotels']= $_POST['hotels'];
    $_SESSION['msg']= $_POST['msg'];





        $datetimeIn = new DateTime($_SESSION['dayin']);
        $datetimeOut = new DateTime($_SESSION['dayout']);
        $interval = $datetimeIn->diff($datetimeOut);
        //number of days booked
        $daysBooked = $interval->format('%R%a');
        //place holder for booking cost
        $value;
   





        //switch to adjust cost for different hotel rates
        switch(isset($_POST['hotels'])){
            case "The blue J" :
                $value = $daysBooked * 1100;
                break;
            case "Green cloud Hotel" :
                $value = $daysBooked * 1300;
                break;
            case " sky mountain Hotel" :
                $value = $daysBooked * 4300;
                break;
            case "skyline hotel" :
                $value = $daysBooked * 2200;
                break;
            default :
                echo "Invalid booking.";
        }
    
        //display booking info for user
        echo "<div class='one'>";

        echo "<br> <center> Title : " . $_SESSION['title'] . "<br>" 
        . "First Name : " . $_SESSION['fname'] . "<br>"
        . "Last Name : " . $_SESSION['lname'] . "<br>" 
        . "phone : " . $_SESSION['phone'] . "<br>" 
    	. "Email : " . $_SESSION['Email'] . "<br>"
	    . "Day In : " . $_SESSION['dayin'] . "<br>"
	    . "Day Out : " . $_SESSION['dayout'] . "<br>"
	    . "Hotel Name : " . $_SESSION['hotels'] . "<br>"
        . "Special Requests: " . $_SESSION['msg'] . "<br>"
        . "Days Bookied: " 
        . $interval->format("%R%a days") . "<br>" . "Total : " . $value . "<br>";

        echo "<br> <button class='btn btn-outline-warning' class='Confirm' name='Confirm' >Confirm Booking</button>";
        echo "</center></div>";
         
    } 
?>


<br><br>


<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" class="needs-validation" novalidate>
  <div class="form-row">

      <div class="col-md-1 mb-3">
          <label for="validationCustomhotel">Title</label>
            <select id="inputState" class="form-control" name="title">
              <option selected> select title</option>
              <option value="MR">MR</option>
              <option value="MRS">MRS</option>
              <option value="MISS">MISS</option>
            </select>
          <div class="invalid-feedback">
            Please provide a valid hotel.
          </div>
        </div>

      <div class="col-md-3 mb-3">
        <label for="validationCustom01">First name</label>
        <input type="text" name="fname" class="form-control" id="validationCustom01" placeholder="First name" required>
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>


      <div class="col-md-4 mb-3">
        <label for="validationCustom02">Last name</label>
        <input type="text" name="lname" class="form-control" id="validationCustom02" placeholder="Last name" value="" required>
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>

    <div class="col-md-3 mb-3">
          <label for="validationCustomphone">Phone number</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroupPrepend">+271</span>
            </div>
            <input type="number" name="phone" class="form-control" id="validationCustomEmail3" placeholder="Phone number" aria-describedby="inputGroupPrepend" required>
            <div class="invalid-feedback">
              Please provide a valid phone number.
            </div>
          </div>
        </div>

    <div class="col-md-3 mb-3">
      <label for="validationCustomEmail">Email</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroupPrepend">@</span>
        </div>
        <input type="email" name="Email" class="form-control" id="validationCustomEmail3" placeholder="Email" aria-describedby="inputGroupPrepend" required>
        <div class="invalid-feedback">
          Please provide a valid Email.
        </div>
      </div>
    </div>

  </div>

 <div class="form-row">

    <div class="col-md-3 mb-3">
      <label for="validationCustomchickin">check in date</label>
      <input type="date" name="dayin" value="" class="form-control" id="validationCustomcheckin" placeholder="check in" required>
      <div class="invalid-feedback">
        Please provide a valid Date.
      </div>
    </div>

    <div class="col-md-3 mb-3">
      <label for="validationCustomchickut">check out date</label>
      <input type="date" name="dayout" value="" class="form-control" id="validationCustomchickut" placeholder="check out" required>
      <div class="invalid-feedback">
        Please provide a valid Date.
      </div>
    </div>

    <div class="col-md-4 mb-3">
          <label for="validationCustomhotel">Please select your Hotel below</label>
            <select id="inputState" class="form-control" name="hotels">
              <option value="">Open to select Hotel</option>
              <option value="The Blue J">The Blue J Hotel</option>
              <option value="Green cloud Hotel">Green cloud Hotel</option>
              <option value="sky Mountain Hotel">Sky Mountain Hotel</option>
            </select>
          <div class="invalid-feedback">
            Please provide a valid hotel.
          </div>
        </div>
    </div>

 </div>


 <div class="col-md-5 mb-3">
      <label for="validationCustommassage"></label>
  <span class="input-group-text"> Massage/Special Requests </span>
  <textarea class="form-control" aria-label="With textarea" name="msg"></textarea>
      <div class="invalid-feedback">
        Please provide a valid Date.
      </div>
    </div>

  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
      <label class="form-check-label" for="invalidCheck">
        Do you Agree that all information are correct
      </label>
      <div class="invalid-feedback">
        You must agree before submitting.
      </div>
    </div>
  </div>

<input type="reset" name="reset">
  <button class="btn btn-primary" type="submit" name="submit">Submit form</button>
</form>
</center>
<hr>




<!-- 
This disables the browser default feedback tooltips, but still provides access to the form validation APIs in JavaScript
-->


<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();


$(document).ready(() => {
    const $menuButton = $('.submit2');
    const $navDropdown = $('.one');
    $menuButton.on('click',()=>{
      $navDropdown.hide();
      $('.book-con').fadeIn(900);
    });
    
  
  
  });


</script>






    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 
  </body>
</html>