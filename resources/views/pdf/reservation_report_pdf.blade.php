<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Reservation Bill</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 2px;
        }

        .header {
            text-align: left;
            margin-bottom: 2px;
            line-height: 0.5;
        }

        .details {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2px;

        }

        .details th,
        .summary th {
            border: 1px solid #ddd;
            padding: 2px;
        }

        .details td,
        .summary td {
            border: 1px solid #ddd;
            padding: 2px;
        }

        .total {
            font-weight: bold;
        }

        .roominfo {
            width: 100%;
            border: 1px solid #ddd;
            margin-top: 20px;
        }

        .roominfo th {
            width: 100%;
            border: 0px solid #ddd;
        }

        .roomrate {
            width: 100%;
            border: 1px solid #ddd;
            margin-top: 20px;
            background-color: #ade8f4;
        }

        .roomrate th {
            width: 100%;
            background-color: #ade8f4;
        }

        .summary {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2px;
            background-color: #caf0f8;
        }

        .signature {
            width: 100%;
            border-collapse: collapse;
            padding-top: 20px;
            margin-bottom: 2px;
            text-align: center;

        }
    </style>
</head>

<body>



    <table>
        <tr>
            <th>
                <div class="header">
                    <h2>The Hotel Luxury</h2>
                    <p>address : Jl Kaliurang km 20</p>
                    <p>Phone : (123) 456-7890</p>
                </div>
            </th>
            <th>
                <div class="logo">
                    <img src="http://127.0.0.1:8000/storage/after-attachments/01JF5FQBZN5J6J8K2ZHH7C8BGF.jpeg" alt="Girl in a jacket">
                </div>

            </th>
        </tr>
    </table>

    <table class="details">
        <tr>
            <th style="text-align: left;">
                <p>Customer First Name</p>
                <p style="font-weight: 400; font-size: 20px; color: blue">{{$record1->first_name}}</p>
            </th>
            <th style="text-align: left;">
                <p>Customer Last Name</p>
                <p style="font-weight: 400; font-size: 20px; color: blue">{{$record1->last_name}}</p>
            </th>
        </tr>
    </table>

    <table class="details">
        <tr>
            <th style="text-align: left; 
            line-height: 0.5;">

                <p>Check In and Check Out Information</p>
                <p style="font-weight: 400;">Check In : 12 December 2024 14:00 </p>
                <p style="font-weight: 400;">Check Out : 14 December 2024 14:00 </p>
            </th>
    </table>
    <table class="roominfo">
        <tr>
            <th style="text-align: left;">
                <p>Room Information</p>
                <p style="font-weight: 400;">Sheila Dara</p>
            </th>
            <th style="text-align: left;">
                <p>Guest Information</p>
                <p style="font-weight: 400;">Paramita</p>
            </th>
            <th style="text-align: left;">
                <p>Special Request</p>
                <p style="font-weight: 400;">Paramita</p>
            </th>
        </tr>
        <tr>
            <th style="text-align: left;">
                <p>Additional Information</p>
                <p style="font-weight: 400;">Paramita</p>
            </th>
        </tr>
    </table>
    <table class="roomrate">
        <tr>
            <th style="text-align: left;">
                <p>Date </p>
                <p style="font-weight: 400;">14 December 2024</p>
            </th>
            <th style="text-align: left;">
                <p>Room Rate</p>
                <p style="font-weight: 400;">IDR 0</p>
            </th>
            <th style="text-align: left;">
                <p>Extra Bed</p>
                <p style="font-weight: 400;">IDR 0</p>
            </th>
            <th style="text-align: left;">
                <p>Subtotal</p>
                <p>IDR 240000</p>
            </th>
        </tr>

    </table>

    <table class="summary">
        <tr>
            <th>
                <p style="font-weight: 400;">Booked annd Payable by </p>
                <p>TERA</p>
            </th>
            <th>Total Amount</th>
            <td class="total">IDR 240000</td>
        </tr>
    </table>

    <div class="terms">
        <p>Terms and Conditions</p>
        <p style="font-size: 14px; line-height: 1;">
            1. All reservations require a valid credit card for guarantee.<br>
            2. Guests are responsible for any damages incurred during their stay.<br>
            2. Guests are responsible for any damages incurred during their stay.<br>
            2. Guests are responsible for any damages incurred during their stay.
        </p>
    </div>


    <table class="signature">
        <tr>
            <td class="signatures">
                <p>____________________</p>
                <p>Guest Signature</p>
            </td>
            <td class="signatures">
                <p>____________________</p>
                <p>Admin Signature</p>
            </td>
        </tr>
    </table>

</body>

</html>