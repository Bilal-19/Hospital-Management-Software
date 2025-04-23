<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $findSalRecord->id }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f6f8;
            color: #333;
            padding: 40px;
            margin: 0;
        }

        .invoice-box {
            background: #fff;
            border-radius: 10px;
            padding: 40px;
            max-width: 800px;
            margin: auto;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h1 {
            margin: 0;
            font-size: 32px;
            color: #4CAF50;
            letter-spacing: 1px;
        }

        .header p {
            font-size: 14px;
            color: #777;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 14px 12px;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .label {
            font-weight: 500;
            color: #555;
            width: 50%;
        }

        .value {
            width: 50%;
        }

        .total-row {
            background: #e8f5e9;
            font-weight: bold;
            color: #2e7d32;
            border-top: 2px solid #c8e6c9;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="header">
            <h1>Salary Slip #{{ $findSalRecord->id }}</h1>
            <p><strong>Date:</strong> {{ \Carbon\Carbon::now()->format('M d, Y') }}</p>
        </div>

        <table>
            <tr>
                <th class="label">Employee Name:</th>
                <td class="value">{{ $findStaffRecord->name }}</td>
            </tr>
            <tr>
                <th class="label">Employee Role:</th>
                <td class="value">{{ $findStaffRecord->role }}</td>
            </tr>
            <tr>
                <th class="label">Basic Salary:</th>
                <td class="value">{{ $findSalRecord->basicSalary }} USD</td>
            </tr>
            <tr>
                <th class="label">Home Rent Allowance:</th>
                <td class="value">{{ $findSalRecord->houseRentAllowance }} USD</td>
            </tr>
            <tr>
                <th class="label">Travel Allowance:</th>
                <td class="value">{{ $findSalRecord->travelAllowance }} USD</td>
            </tr>
            <tr>
                <th class="label">Medical Allowance:</th>
                <td class="value">{{ $findSalRecord->medicalAllowance }} USD</td>
            </tr>
            <tr class="total-row">
                <th class="label">Gross Earning:</th>
                <td class="value">{{ $findSalRecord->grossEarning }} USD</td>
            </tr>
        </table>

    </div>
</body>
</html>
