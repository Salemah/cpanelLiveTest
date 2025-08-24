<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
            margin: 0;
            padding: 20px;
        }

        .invoice-box {
            max-width: 900px;
            margin: auto;
            background: #fff;
            border: 2px solid #9acd32;
            padding: 20px;
            border-radius: 6px;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .invoice-header img {
            max-height: 60px;
        }

        .invoice-status {
            padding: 5px 10px;
            background: #28a745;
            color: #fff;
            font-size: 14px;
            border-radius: 4px;
        }

        .section {
            margin-top: 20px;
        }

        .section h4 {
            background: #32cd32;
            color: #fff;
            padding: 8px;
            margin: 0;
            border-radius: 4px 4px 0 0;
        }

        .section table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #32cd32;
        }

        .section table th,
        .section table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
        }

        .section table th {
            text-align: left;
            background: #f2f2f2;
        }

        .totals {
            text-align: right;
            font-size: 14px;
            padding: 5px 0;
        }

        .footer {
            margin-top: 20px;
            text-align: right;
        }

        .footer button {
            background: #32cd32;
            border: none;
            color: white;
            padding: 8px 15px;
            margin-left: 10px;
            cursor: pointer;
            border-radius: 4px;
        }

        .footer button:hover {
            background: #28a745;
        }
    </style>


    <style>
/* .container {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 2rem;
  justify-content: space-between;
} */
.container {
  display: flex;
  justify-content:space-between !important; /* left & right with space between */
  gap: 2rem; /* optional extra space */
}

.column {
  flex: 1;             /* makes them equal width */
  margin: 0 0.5rem;    /* optional spacing */
  background: #f0f0ff;
  padding: 1rem;
  border-radius: 8px;
}

.column {
  padding: 1rem;
  border-radius: 8px;
  background-color: hsla(240, 61%, 90%, 0);
}


    </style>
</head>

<body>

    <div class="invoice-box">
        <a role="button" style="
                display: inline-block;
                outline: 0;

                cursor: pointer;
                border: none;
                 padding: 0 13px;
                height: 20px;
                line-height: 20px;
                border-radius: 7px;
                font-weight: 400;
                font-size: 16px;
                background: #da5656;
                color: #ffffff;
                text-decoration:none;
                box-shadow: 0 4px 14px 0 rgb(0 0 0 / 10%);
                transition: background 0.2s ease,color 0.2s ease,box-shadow 0.2s ease;
                :hover{
                    background: rgba(255,255,255,0.9);
                    box-shadow: 0 6px 20px rgb(93 93 93 / 23%);
                }
                " href="{{ url('our_team') }}">
            <-Back
        </a>
        <!-- Header -->
        <div class="invoice-header">
            <img src="{{ asset('arc.jpg') }}" alt="Logo">
            <div>
                @if ($data['appointment']->status != 'Confirmed')
                <a href=""
                style="
                display: inline-block;
                outline: 0;

                cursor: pointer;
                border: none;
                padding: 0 56px;
                height: 45px;
                line-height: 45px;
                border-radius: 7px;
                text-decoration:none;
                font-weight: 400;
                font-size: 16px;
                background: #ff0202;
                color: #ffffff;
                box-shadow: 0 4px 14px 0 rgb(0 0 0 / 10%);
                transition: background 0.2s ease,color 0.2s ease,box-shadow 0.2s ease;
                :hover{
                    background: rgba(255,255,255,0.9);
                    box-shadow: 0 6px 20px rgb(93 93 93 / 23%);
                }
                ">
                Pay Now</a>
                @endif
                <h2>Invoice # {{ $data['appointment']->booking_id }} </h2>
                <p><strong>
                        @if ($data['appointment']->status != 'Confirmed')
                            Due Date
                        @else
                            Paid
                        @endif:
                    </strong> {{ $data['appointment']->booking_date }}</p>
                    <p><span
                        class="invoice-status">{{ $data['appointment']->status }}</span></p>
            </div>
        </div>


        <!-- Invoiced To -->
        <div class="section">
            <table width="100%">
                <tr>
                    <td>
                        <strong>Invoiced To</strong><br>
                        {{ $data['appointment']->name }}<br>

                    </td>
                    <td style="text-align:right">
                        <strong>Pay To</strong><br>
                        {{ $data['Setting']->title }}<br>
                        {{ $data['Setting']->address }}<br>
                        Email: {{ $data['Setting']->email }}<br>
                        Call: {{ $data['Setting']->phone }} (10AM–8PM)
                    </td>
                </tr>
            </table>
        </div>

        <!-- Invoice Items -->
        <div class="section">
            <h4>Invoice Items</h4>
            <table>
                <tr>
                    <th>Description</th>
                    <th style="text-align:right">Amount</th>
                </tr>
                <tr>
                    <td>Consultation with Senior Lawyer – Family Law {{ $data['appointment']->booking_date }}
                        {{ $data['appointment']->booking_time }}</td>
                    <td style="text-align:right">TK {{ number_format($data['appointment']->amount, 2) }} BDT</td>
                </tr>

                <tr>
                    <td class="totals"><strong>Sub Total</strong></td>
                    <td style="text-align:right">TK {{ number_format($data['appointment']->amount, 2) }} BDT</td>
                </tr>
                <tr>
                    <td class="totals">2.00% Transaction Fee</td>
                    <td style="text-align:right">TK 0.00 BDT</td>
                </tr>

                <tr>
                    <td class="totals"><strong>Total</strong></td>
                    <td style="text-align:right"><strong>TK {{ number_format($data['appointment']->amount, 2) }}
                            BDT</strong></td>
                </tr>
            </table>
            <p style="font-size:12px; margin-top:5px;">* Indicates a taxed item.</p>
        </div>

        @if ($data['appointment']->status == 'Confirmed')
            <div class="section">
                <h4>Transactions</h4>
                <table>
                    <tr>
                        <th>Transaction Date</th>
                        <th>Gateway</th>
                        <th>Transaction ID</th>
                        <th>Amount</th>
                    </tr>
                    <tr>
                        <td>22/08/2025</td>
                        <td>bKash Payment</td>
                        <td>CHM6P7F4D2</td>
                        <td>TK 30.00 BDT</td>
                    </tr>
                </table>
            </div>
        @endif
        <!-- Transactions -->


        <!-- Footer -->
        <div class="footer">
            <button onclick="window.print()">Print</button>

        </div>
    </div>

</body>

</html>
