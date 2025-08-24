<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Invoice Notification</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background: #f7f7f7;
    }
    .email-container {
      max-width: 650px;
      margin: 20px auto;
      background: #ffffff;
      border: 1px solid #ddd;
    }
    .header {
      background: #f0f0f0;
      padding: 15px;
      text-align: center;
      border-bottom: 3px solid #444;
    }
    .header img {
      max-height: 60px;
    }
    .content {
      padding: 20px;
      font-size: 14px;
      line-height: 1.6;
      color: #333;
    }
    .invoice-items {
      margin-top: 15px;
      padding: 10px;
      border-top: 1px solid #ddd;
      border-bottom: 1px solid #ddd;
      background: #fafafa;
    }
    .footer {
      padding: 20px;
      font-size: 13px;
      background: #f9f9f9;
      border-top: 1px solid #ddd;
    }
    .footer .contact {
      margin-top: 10px;
      font-size: 13px;
    }
    .footer a {
      color: #0066cc;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="email-container">

    <!-- Header -->
    <div class="header bg-primary">
    <p>{{$data['title']}}</p>
    </div>


    <!-- Content -->
    <div class="content">
      <p>Dear <strong>{{$data['appointment']->name}}</strong>,</p>

      <p>This is a notice that an invoice has been generated on <strong>{{$data['appointment']->booking_date}}</strong>.</p>

      <p>Your payment method is: <strong>bkash Payment</strong></p>

      <p>
        <strong>Invoice #{{$data['appointment']->booking_id}}</strong><br>
        <strong>Amount Due:</strong> TK {{number_format($data['appointment']->amount,)}} BDT<br>
        <strong>Due Date:</strong> {{$data['appointment']->booking_date}}
      </p>

      <h4>Invoice Items</h4>
      <div class="invoice-items">
        <p>
    Consultation with {{$data['appointment']->employee->positions}} <br>
    Client: {{$data['appointment']->name}} <br>
    Appointment Date: <b> {{$data['appointment']->booking_date}} {{$data['appointment']->booking_time}} </b><br>
    + Document Review <br>
    + Legal Advice on Case
  </p>
        <p>
          -------------------------------------------<br>
          Sub Total: TK {{number_format($data['appointment']->amount,2)}} BDT <br>
          2.00% Transaction Fee: TK 0.00 BDT <br>

          <strong>Total: {{number_format($data['appointment']->amount,2)}} BDT</strong>
        </p>
      </div>

      <p>
        You can login to your client area to view and pay the invoice or Call Us Payment Confirmation</a>
      </p>
      <p>Or pay the invoice at <a href="{{ route('pdf.download', ['id' => $data['appointment']->id]) }}">{{ route('pdf.download', ['id' => $data['appointment']->id]) }}</a></p>

      <p>Regards, <br>
      System Administrator <br>
      {{$data['title']}}</p>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>{{$data['title']}}</p>
      {{-- <img src="{{asset($data['Setting']->logo)}}" alt="PutulHost Logo" style="max-height:40px;"><br> --}}
      <div class="contact">
        <strong>Call:</strong> {{$data['Setting']->phone}} <br>
        <strong>Email:</strong> {{$data['Setting']->email}} <br>

      </div>
    </div>
  </div>
</body>
</html>

