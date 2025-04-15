<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $findInvoice->id }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            padding: 40px;
            margin: 0;
        }

        .invoice-box {
            border: 1px solid #eee;
            padding: 30px;
            max-width: 700px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
            color: #4CAF50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td, th {
            padding: 12px 8px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        .total {
            font-weight: bold;
            color: #000;
        }

        .label {
            width: 30%;
            color: #555;
        }

        .value {
            width: 70%;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #aaa;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="header">
            <h1>Invoice #{{ $findInvoice->id }}</h1>
            <p><strong>Date:</strong> {{ \Carbon\Carbon::now()->format('M d, Y') }}</p>
        </div>

        <table>
            <tr>
                <th class="label">Patient Name:</th>
                <td class="value">{{ $findInvoice->patientName }}</td>
            </tr>
            <tr>
                <th class="label">Doctor Name:</th>
                <td class="value">{{ $findInvoice->doctorName }}</td>
            </tr>
            <tr>
                <th class="label">Service Name:</th>
                <td class="value">{{ $findInvoice->serviceName }}</td>
            </tr>
            <tr>
                <th class="label">Test Name:</th>
                <td class="value">{{ $findInvoice->testName }}</td>
            </tr>
            <tr>
                <th class="label">Medicines:</th>
                <td class="value">{{ $findInvoice->medicineName }}</td>
            </tr>
            <tr>
                <th class="label total">Total Amount:</th>
                <td class="value total">${{ $findInvoice->totalAmount }}</td>
            </tr>
        </table>

        <div class="footer">
            Thank you for choosing our clinic. Get well soon!
        </div>
    </div>
</body>
</html>
