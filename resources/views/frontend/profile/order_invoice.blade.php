<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Invoice</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    .font tr td:nth-child(2){
        padding-left: 1rem;
        font-size: 14px;
    }

    .font tr td:nth-child(1){
        font-weight:  600;
        line-height: 1rem;
    }

    h2 h3{
        margin: 0;
    }

    
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
    .font{
      font-size: 15px;
    }
    .authority {
        /*text-align: center;*/
        float: right
    }
    .authority h5 {
        margin-top: -10px;
        color: #418db9;
        /*text-align: center;*/
        margin-left: 35px;
    }
    .thanks p {
        color: #418db9;;
        font-size: 16px;
        font-weight: normal;
        font-family: serif;
        margin-top: 20px;
    }



</style>

</head>

<body>

  <table width="100%" style="background: #F7F7F7; padding: 20px; padding-top:5px;">

    <tr>
        <td width ="50%">
            <h1 style="color: green; font-size: 30px; margin-bottom:10px;">
                <strong>{{$data['company_name']}}</strong>
            </h1>
            <h3 style=" margin:0; margin-left:10px;"><span>Ref #:</span> {{$data['invoice_no'] }}</h3>

        </td>

        <td  width ="40%" align="right">
           <h3 style=" margin-bottom:0;"> {{$data['company_name']}} Head Office</h3>
            <small> {{$data['company_email']}}</small>
             <br>
            <small> {{$data['company_phone'] }}</small>
        </td>

    </tr>

  </table>


  <table width="100%" style="background:white; padding:2px;"></table>

  <table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;">
    <tr>
        <td>
            <table class="font" style="margin-left: 20px;">
                <tr>
                    <td> Name: </td>
                    <td> {{ $data['user_name'] }}</td>
                </tr>

                <tr>
                    <td> Email: </td>
                    <td> {{ $data['user_email'] }}</td>
                </tr>

                <tr>
                    <td> Phone: </td>
                    <td> {{ $data['user_phone'] }}</td>
                </tr>

                <tr>
                    <td> Address: </td>
                    <td> {{$data['user_address']}}</td>
                </tr>

                <tr>
                    <td> Post Code: </td>
                    <td> {{$data['user_zipcode']}}</td>
                </tr>

            </table>
        </td>

        <td>

            <table class="font" style="margin-left: 20px;">
                <tr>
                    <td> Pace On: </td>
                    <td> {{$data['place_date'] }}</td>
                </tr>

                <tr>
                     
                    <td>Paid On: </td>
                    <td>{{$data['paid_date'] }}</td>
                </tr>

                <tr>
                    <td> Delivery Date: </td>
                    <td>{{$data['shipped_date'] }}</td>
                </tr>

                <tr>
                    <td> Payment Type: </td>
                    <td>{{$data['payment_method'] }}</td>
                </tr>

                <tr>
                    <td> Transaction #: </td>
                    <td>{{$data['transaction_id'] }}</td>
                </tr>
            </table>

        </td>
    </tr>
  </table>
  <br/>
<h3>Products</h3>


  <table width="100%">
    <thead style="background-color: #418db9; color:#FFFFFF;">

      <tr class="font">
        <th>Image</th>
        <th>Product Name</th>
        <th>Color</th>
        <th>Quantity</th>
        <th>Unit Price </th>
        <th>Total </th>
      </tr>
    </thead>

    <tbody>

        @php
            $cart = $data['cart']
        @endphp

     @foreach($cart as $item)
      <tr class="font">
        <td align="center">
            <img src="{{ public_path($item['productImg'])}}" height="60px;" width="60px;" alt="">
        </td>
        <td style="padding: 0 1rem"> 
            <strong>{{$item['productName'] }}</strong>
            <br>
            <small style="font-size: 12px">Size: {{$item['productSize'] }}</small>
        </td>


        <td align="center">{{$item['productColor']}}</td> 
        <td align="center">{{$item['productQty'] }}</td>
        <td align="center">{{ $item['productPrice'] }}</td>
        <td align="center">{{ $item['productSum']  }} </td>
      </tr>
      @endforeach
      
    </tbody>
  </table>
  <br>
  <hr>
  
  <table width="100%">
    <tbody>
        <tr>
            <td style="padding: 2rem; width:60%">
            <p> <h2 style="margin: 0"> Thanks for using {{$data['company_name']}}...</h2> <br>
                If you have any questions about this, please email us on {{$data['company_email']}} 
                to reach out our support team for help.
            </p>

            </td>
            <td>
            <div class="authority float-right mt-5" style="padding-right: 1rem; width:100%;">

                <table style="width: 100%">

                    <tr>
                        <td align="right" > <h2  style="color: #418db9;">Subtotal: </h2></td>
                        <td width="30%" style="font-size: 16px; padding-left:1rem">    {{$data['sub_total']}} </td>
                    </tr>
                
                    @php
                    $dicount = round((float)$data['sub_total']-(float)$data['amount']);
                    $amount = "P". $data['amount']
                    @endphp
                
                
                    @if ( $dicount > 0)
                        <tr>
                            <td align="right" > <h2  style="color: #418db9; margin: 0.2rem;">Discout: </h2></td>
                            <td width="30%"  style="font-size: 16px; padding-left:1rem"> <small>-  {{$dicount}}</small> </td>
                        </tr>
                    @endif
                
                    <tr>
                        <td align="right" > <h2  style="color: #418db9;">Amount Paid: </h2></td>
                        <td width="30%"  style="font-size: 16px; padding-left:1rem"> 
                          {{$amount}}
                        </td>
                    </tr>
                </table>

            </div>
            </td>

        </tr>
    </tbody>
  </table>

  <hr>
  <br>
  <br>

  <div class="authority float-right mt-5">
      <p>------------------------------------</p>
      <h5> Authority Signature</h5>
    </div>
</body>
</html>