<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bkash Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fc;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .payment-container {
            background: #fff;
            width: 400px;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .payment-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .payment-header h2 {
            margin: 0;
            color: #e2136e;
            /* Bkash Pink */
        }

        .details p {
            font-size: 15px;
            color: #444;
            margin: 10px 0;
        }

        .highlight {
            font-weight: bold;
            color: #111;
        }

        .input-group {
            margin: 15px 0;
        }

        .input-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #333;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
            background: #e2136e;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>

<body>

    <div class="payment-container">
        <div class="payment-header">
            <h2>Bkash Payment</h2>
            <p>Payment Method: <span class="highlight">Bkash</span></p>
        </div>

        <div class="details">
            <p>Merchant Number: <span class="highlight">{{ $Setting->phone }}</span></p>
            <p>Amount to Pay: <span class="highlight">{{ $appointment->amount }} ৳ </span></p>
            <p>Please send the money to the above Bkash number.</p>
        </div>

        <form id="appointmentPaymentForm" method="POST" action="{{ route('appointments.payment.submit') }}">
            @csrf
            <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
            <input type="hidden" name="amount" value="{{ $appointment->amount }}">

            <div class="input-group">
                <label for="payer-number">Your Bkash Number</label>
                <input type="text" id="payer-number" name="payer_number" placeholder="Enter your Bkash number"
                    value="{{ old('payer_number') }}" required>
                @error('payer_number')
                    <p style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="input-group">
                <label for="transaction-id">Transaction ID (Bkash TRX ID)</label>
                <input type="text" id="transaction-id" name="trx_id" placeholder="Enter TRX ID"
                    value="{{ old('trx_id') }}" required>
                @error('trx_id')
                    <p style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn">Submit Payment</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('appointmentPaymentForm').addEventListener('submit', function(e) {
    e.preventDefault();

    let form = this;

    fetch(form.action, {
        method: "POST",
        body: new FormData(form),
        headers: {
            "X-CSRF-TOKEN": document.querySelector('input[name=_token]').value
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            // ✅ SweetAlert instead of alert()
            Swal.fire({
                title: "Success!",
                text: data.message,
                icon: "success",
                confirmButtonText: "OK"
            }).then(() => {
                // redirect after clicking OK
                window.location.href = data.redirect;
            });
        } else {
            Swal.fire({
                title: "Error!",
                text: "Something went wrong!",
                icon: "error",
                confirmButtonText: "Try Again"
            });
        }
    })
    .catch(err => {
        Swal.fire({
            title: "Error!",
            text: "Unexpected error occurred.",
            icon: "error"
        });
        console.error(err);
    });
});
</script>

</body>

</html>
