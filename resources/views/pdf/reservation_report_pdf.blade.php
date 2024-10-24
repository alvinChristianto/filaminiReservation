
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Reservation Bill</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .details, .summary {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .details th, .summary th {
            background-color: #f2f2f2;
            padding: 10px;
        }
        .details td, .summary td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .total {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Hotel Name</h1>
        <p>Address Line 1</p>
        <p>Address Line 2</p>
        <p>Phone: (123) 456-7890</p>
        <h2>Billing Statement</h2>
    </div>

    <table class="details">
        <tr>
            <th>Guest Name</th>
            <th>Check-in Date</th>
            <th>Check-out Date</th>
            <th>Room Type</th>
            <th>Nights</th>
            <th>Rate per Night</th>
        </tr>
        <tr>
            <td>John Doe</td>
            <td>2023-10-01</td>
            <td>2023-10-05</td>
            <td>Deluxe Suite</td>
            <td>4</td>
            <td>$150</td>
        </tr>
    </table>

    <table class="summary">
        <tr>
            <th>Total Amount</th>
            <td class="total">$600</td>
        </tr>
    </table>

    <div class="terms">
        <h2>Terms and Conditions</h2>
        <p>1. All reservations require a valid credit card for guarantee.</p>
        <p>2. Cancellations must be made 24 hours prior to check-in to avoid charges.</p>
        <p>3. Check-in time is after 3:00 PM and check-out time is before 11:00 AM.</p>
        <p>4. Guests are responsible for any damages incurred during their stay.</p>
        <p>5. The hotel reserves the right to refuse service to anyone.</p>
    </div>
  
  
    <table class="summary">
        <tr>
            <td class="signatures"> 
              <p>____________________</p>
            <p>Guest Signature</p>
          </td>
            <td class="signatures"> 
              <p>____________________</p>
            <p>Guest Signature</p>
          </td>
        </tr>
    </table>
  
</body>
</html>
