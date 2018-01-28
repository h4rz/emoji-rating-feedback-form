
<?php

	include "database.php";
	// define variables and set to empty values
	$nameErr = $emailErr = $rateAppErr = $rateSatisErr = "";
	$name = $email = $rateApp = $rateSatis = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		if (empty($_POST["name"])) 
	  	{
	    	$nameErr = "Name is required";
	  	} 
	  	else 
	  	{
	    	$name = test_input($_POST["name"]);
		    // check if name only contains letters and whitespace
		    if (!preg_match("/^[a-zA-Z ]*$/",$name)) 
		    {
		      $nameErr = "Only letters and white space allowed"; 
		    }
	  	}
	  
	  	if (empty($_POST["email"])) 
	  	{
	    	$emailErr = "Email is required";
	  	} 
	  	else 
	  	{
		    $email = test_input($_POST["email"]);
		    // check if e-mail address is well-formed
		    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
		    {
		      $emailErr = "Invalid email format"; 
		    }
	  	}
	    
	  	if (empty($_POST["ratingAppearance"])) 
	  	{
	    	$rateAppErr = "Please Rate The Appearance";
	  	} 
	  	else 
	  	{
	    	$rateApp = $_POST["ratingAppearance"];
	  	}

	  	if (empty($_POST["ratingSatisfaction"])) 
	  	{
	    	$rateSatisErr = "Please Rate The Satisfaction Level";
	  	} 
	  	else 
	  	{
	    	$rateSatis = $_POST["ratingSatisfaction"];
	  	}

		$stmt = $conn->prepare("INSERT INTO ".$tbname." (name, email, rateApp, rateSatis) VALUES (?, ?, ?, ?)");
		$stmt->bind_param("ssss", $name, $email, $rateApp, $rateSatis);
		$stmt->execute();
		$stmt->close();
		
	}

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
?>



<!DOCTYPE html>
<html lang="en">
	<head>
	  <title>Feedback Form</title>
	  <style>.error {color: #FF0000;}</style>
	  <?php include "links.php";?>
	</head>
	<body>
		<div class="container">
		  <div class="col-md-8 col-md-offset-2">
		    <div class="panel panel-primary">
		      <div class="panel-heading">Time For Feedback !!</div>
		      <div class="panel-body">
		      	<form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		    		<div class="form-group">
		      			<label class="control-label col-sm-2" for="email">Email:</label>
		      			<div class="col-sm-10">
		        			<input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
		        			<span class="error"><?php echo $emailErr;?></span>
		      			</div>
				    </div>
				    <div class="form-group">
		      			<label class="control-label col-sm-2" for="name">Full Name:</label>
		      			<div class="col-sm-10">
		        			<input type="text" class="form-control" id="name" placeholder="Enter full name" name="name">
		        			<span class="error"><?php echo $nameErr;?></span>
		      			</div>
				    </div>
				    <div class="form-group">
				      	<div class="col-sm-offset-2 col-sm-10">
				      		<label class="control-label" for="appearance">Appearance:</label>        
					        <div class="radio">
					          <label class="radio-inline">
					          	<input type="radio" name="ratingAppearance" value="Poor">
					          	<img src="emoji/001-poor.png" class="img-thumbnail" alt="Poor">
					          </label>
					          <label class="radio-inline">
					          	<input type="radio" name="ratingAppearance" value="Average">
					          	<img src="emoji/002-average.png" class="img-thumbnail" alt="Average">
					          </label>
					          <label class="radio-inline">
					          	<input type="radio" name="ratingAppearance" value="Happy">
					          	<img src="emoji/003-happy.png" class="img-thumbnail" alt="Happy">
					          </label>
					          <label class="radio-inline">
					          	<input type="radio" name="ratingAppearance" value="Very Happy">
					          	<img src="emoji/004-very-happy.png" class="img-thumbnail" alt="Very Happy">
					          </label>
					        </div>
					        <span class="error"><?php echo $rateAppErr;?></span>
					    </div>
				    </div>
				    <div class="form-group">
				      	<div class="col-sm-offset-2 col-sm-10">
				      		<label class="control-label" for="appearance">Overall Satisfaction Level:</label>
					        <div class="radio">
					          <label class="radio-inline">
					          	<input type="radio" name="ratingSatisfaction" value="Poor">
					          	<img src="emoji/001-poor.png" class="img-thumbnail" alt="Poor">
					          </label>
					          <label class="radio-inline">
					          	<input type="radio" name="ratingSatisfaction" value="Average">
					          	<img src="emoji/002-average.png" class="img-thumbnail" alt="Average">
					          </label>
					          <label class="radio-inline">
					          	<input type="radio" name="ratingSatisfaction" value="Happy">
					          	<img src="emoji/003-happy.png" class="img-thumbnail" alt="Happy">
					          </label>
					          <label class="radio-inline">
					          	<input type="radio" name="ratingSatisfaction" value="Very Happy">
					          	<img src="emoji/004-very-happy.png" class="img-thumbnail" alt="Very Happy">
					          </label>
					        </div>
					        <span class="error"><?php echo $rateSatisErr;?></span>
					    </div>
				    </div>
				    <div class="form-group">        
				      <div class="col-sm-offset-2 col-sm-10">
				        <button type="submit" class="btn btn-default">Submit</button>
				      </div>
				    </div>
		  		</form>
		      </div>
		    </div>
		  </div>
		</div>
	</body>
</html>


