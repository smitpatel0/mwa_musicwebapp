<?php
$host = 'localhost';
$username = 'root'; // Replace with your DB username
$password = '';     // Replace with your DB password
$dbname = 'mwa';

$conn = new mysqli($host, $username, $password, $dbname);

echo "<style>
a {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

a:hover {
    background-color: #0056b3;
}
</style>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $card_number = $_POST['cardNumber'];
    $expiry_date = $_POST['expiryDate'];
    $subscription_amount = $_POST['amount'];
    $subscription_type = $_POST['subscriptionType'];

    // Prepare SQL statement
    $sql = "INSERT INTO payment_details (name, email, card_number, expiry_date, subscription_amount, subscription_type)
            VALUES ('$name', '$email', '$card_number', '$expiry_date', '$subscription_amount', '$subscription_type')";

    if ($conn->query($sql) === TRUE) {
        echo "<h2>Payment details saved successfully!</h2>";
        echo "<h3>Entered Data:</h3>";
        echo "<table border='1' style='border-collapse: collapse; width: 50%; text-align: left;'>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Card Number</th>
                    <th>Expiry Date</th>
                    <th>Subscription Amount</th>
                    <th>Subscription Type</th>
                </tr>
                <tr>
                    <td>$name</td>
                    <td>$email</td>
                    <td>$card_number</td>
                    <td>$expiry_date</td>
                    <td>$subscription_amount</td>
                    <td>$subscription_type</td>
                </tr>
              </table>";
			  echo "<a href='../dashboard/index1.html'>Click To Go Home Page</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
