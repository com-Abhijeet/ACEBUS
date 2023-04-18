<!DOCTYPE html>
<html>
<head>
	<title>Payment Page</title>
    <style>
        /* Style for form */
form {
  margin: 0 auto;
  max-width: 500px;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-family: Arial, Helvetica, sans-serif;
}

/* Style for headings */
h1 {
  text-align: center;
}

/* Style for labels */
label {
  display: block;
  margin-top: 20px;
  font-size: 1.1em;
}

/* Style for input fields */
input[type="text"] {
  width: 100%;
  padding: 10px;
  margin-top: 5px;
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

/* Style for select fields */
select {
  width: 100%;
  padding: 10px;
  margin-top: 5px;
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

button {
			background-color: #4CAF50;
			color: white;
			padding: 14px 20px;
			margin: 8px 0;
			border: none;
			cursor: pointer;
			border-radius: 4px;
		}

		button:hover {
			background-color: #4CAF50;
		}

		.clear-btn {
			background-color: #4CAF50;
		}

/* Style for form error messages */
.error {
  color: #4CAF50;
  font-size: 0.8em;
}
    </style>
	<h1>PAYMENT PAGE</h1>
	<style>
		.card {
			background-color: #4CAF50;
			border-radius: 10px;
			color: white;
			padding: 20px;
			text-align: center;
			width: 350px;
		}
		
		.card-number {
			font-size: 30px;
			margin-bottom: 20px;
		}
		
		.cvv {
			font-size: 20px;
			margin-top: 30px;
		}
		
		.expiry-date {
			font-size: 20px;
			margin-left: 20px;
			margin-top: 30px;
		}
	</style>
</head>
<body>
	<div class="card">
		<div class="card-number">1234 5678 9012 3456</div>
		<div class="expiry-date">MM/YY 06/25</div>
		<img src="cvv.png" alt="CVV" class="cvv">
	</div>
</body>
<body>
	<form>
        <label for="name">NAME:</label><br>
		<input type="text" id="name" name="name"><br>

		<label for="card-number">Card Number:</label><br>
		<input type="text" id="card-number" name="card-number"><br>
		
		<label for="expiration-date">Expiration Date:</label><br>
		<input type="text" id="expiration-date" name="expiration-date"><br>
		
		<label for="cvv">CVV:</label><br>
		<input type="text" id="cvv" name="cvv"><br>
		
		<label for="amount">Amount:</label><br>
		<input type="text" id="amount" name="amount"><br>
		
		<label for="payment-method">Payment Method:</label><br>
		<select id="payment-method" name="payment-method">

			<option value="debit-card">Debit Card</option>
            <option value="UPI">UPI</option>

		</select>
        <script>
            function redirectToPage() {
                var selectedValue = document.getElementById("payment-method").value;
                
                if (selectedValue === "debit-card") {
                    window.location.href = "https://yourwebsite.com/debit-card-payment-page.html";
                } else if (selectedValue === "UPI") {
                    window.location.href = "UPI.html";
                }
            }
        </script>
		
		<button name="payment-button">Pay</button>
	    <button class="clear-btn">Clear</button>
        <script>
            function redirectToHome() {
                var selectedValue = document.getElementById("payment-buttin").value;
                window.location.href = "/ACEBUS//php/index.php";
                    
            }
            
        </script>
	</form>
	
</body>
</html>
