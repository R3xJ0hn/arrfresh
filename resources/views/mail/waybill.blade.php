@php
 use Carbon\Carbon;
@endphp

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style>
    @page{
      margin: 1rem;
    }

    body{
      font-family: "Nunito Sans", Helvetica, Arial, sans-serif;
      margin:0;
      padding: 0; 
      width: 100% !important;
      height: 100%;
      -webkit-text-size-adjust: none;
    }

    h1 {
      margin-top: 0;
      color: #333333;
      font-size: 28px;
      font-weight: bold;
      text-align: left;
    }
    
    h2 {
      margin: 0;
      color: #333333;
      font-size: 16px;
      font-weight: bold;
      text-align: left;
    }

    h3 {
      margin: 0;
      color: #333333;
      font-size: 14px;
      font-weight: bold;
      text-align: left;
    }

    table {
      width: 100%;
      margin: 0;
      padding: 10px 0;
      line-height: 18px;
    }

    small{
        font-weight: normal;
        font-size: 10px;
    }

    .des_label{
        margin-top: 3px ;
        margin-bottom: 2px ;
    }

    .des_id{
        margin-bottom: 2px ;
        font-weight: normal;
        font-size: 12px;
    }

    .orderDate, .shipDate {
      margin: 0;
      color: #333333;
      font-size: 14px;
      font-weight: bold;
      text-align: left;
      margin-top: 10px ;
      margin-bottom: 2px ;
    }
    
    .shipDate span{
      font-size: 15px;
      margin-bottom: 10px;
    }
    
    .orderDate span{
      font-size: 15px;
      margin-bottom: 10px;
    }

    .consigneeName{
      margin: 15px 0 25px 0;
      color: #333333;
      font-size: 15px;
      font-weight: bold;
      text-align: left;
    }

    .qr-code{
      position: absolute;
      top: -3px;
      right: 30px;
    }

    
    /* Utilities ------------------------------ */
    
    .border{
      border: 1px solid #333333;
    }

  </style>
</head>
<body>
  
<table width="100%">
  
  <tr width="100%">
    <td>
      <h1 >
      {{$invoice['company_name']}}
      </h1>
    </td>
    <td >
      <div class="qr-code">
        {!!DNS2D::getBarcodeHTML($invoice['company_url'], 'QRCODE',4,4)!!}
      </div>
    </td>
  </tr>

  <tr>
    <td>
      <h3 class="consigneeName"> {{$invoice['user_name']}}</h3>
    </td>
  </tr>

  <tr>

    <td width="55%">
        <span class="shipDate">
            Shipped Date:
            <span>{!!Carbon::create($invoice['place_date'])->format('d M')!!}</span>
        </span>
    </td>

    <td>
      <span class="orderDate">
        OrderDate:
        <span>{!!Carbon::create($invoice['place_date'])->format('d M')!!}</span>
      </span>
    </td>

  </tr>

  <tr>
    <td >
        <h3 class="des_label">Invoice Number</h3>
        <h3 class="des_id">{{$invoice['invoice_no']}}</h3>
    </td>
    <td > 
        <h3 class="des_label">Item/s in Package:</h3>
        <h3 class="des_id">{{$invoice['total_units']}}</h3>
    </td>
  </tr>

  <tr>
    <td>
      <h3 class="des_label">Tracking Number</h3>
      <h3 class="des_id">{{$invoice['tracking_no']}}</h3>
    </td>

    <td  >
        <span class="shipDate" >
          {{($invoice['payment_method'] == 'Cash On Deliver')? 'COD':'NON-COD'}}: PHP {{ number_format(($invoice['amount']),2) }}
        </span>
    </td>
  </tr>
    
  <tr>
    <td style="text-align: center">
      {!!DNS1D::getBarcodeHTML($invoice['invoice_no'], 'EAN13',2,90)!!}
      <small>{{$invoice['invoice_no']}}</small>
    </td>

    <td>
      <div style="margin-left: 1rem;">
          <h3 class="des_label">Address</h3>
          <h3 class="des_id">{{$invoice['user_address']}}</h3>
      </div>

      <div style="margin-left: 1rem;">
          <h3 class="des_label">Contact#:</h3>
          <h3 class="des_id">{{$invoice['user_phone']}}</h3>
      </div>
    </td>
  </tr>
<br>
  <tr style="padding: 1rem; text-align: center;">
    <small>{{$invoice['tracking_no']}}</small>
    {!!DNS1D::getBarcodeHTML($invoice['tracking_no'], 'EAN13',3.7,100)!!}
  </tr>
</table>

</body>
</html>