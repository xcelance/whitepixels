
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <style>

      </style>
    </head>
    <body>
        <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" class="" style="max-width:750px;">
            <tr>
                <td style="padding:10px;" class="em_padd" valign="top" bgcolor="#000" align="center">
                    <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                        <tbody>
                            <tr>
                                <td style="text-align: center;" valign="top" align="center"><img src="{{url('/public/vendor/avored-default/images/mail-site-logo.png')}}" alt="whitepixel-logo" width="110px"></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
        <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" class="" style="max-width:750px;">
            <tr>
                <td style="padding-top: 12px;padding-bottom: 22px;" class="em_padd" valign="top" align="center">
                    <table width="100%" cellspacing="0" cellpadding="0" border="1" align="center" 
                       style="border-color: #2c2c2c;">
                        <tbody>
                            <tr style="background: #f2f2f2;">
                                 <th style="padding: 12px; text-align: left;border: 0;">
                                   SI.
                                </th>
                                <th style="padding: 12px; text-align: left;border: 0;">
                                   Job Id
                                </th> 
                                 <th style="padding: 12px; text-align: left;border: 0;">
                                   Product
                                </th> 
                                <th style="padding: 12px; text-align: left;border: 0;">
                                   TAT
                                </th> 
                                <th style="padding: 12px; text-align: left;border: 0;">
                                   Qty
                                </th> 
                                <th style="padding: 12px; text-align: left;border: 0;">
                                   Vat(%)
                                </th>
                                <th style="padding: 12px; text-align: left;border: 0;">
                                   Price
                                </th>
                                <th style="padding: 12px; text-align: left;border: 0;">
                                   Total Price
                                </th>    
                            </tr>
                            @php $cnt=1; $total=0; @endphp
                            @foreach($mail_order_data as $value)
                            <tr>
                                 <td style="padding-top: 4px; font-weight: 600;padding: 12px;border: 0;border-top: 1px solid #2c2c2c;">
                                  {{$cnt++}}
                                </td>
                                <td style="padding-top: 4px; font-weight: 600;padding: 12px;border: 0;border-top: 1px solid #2c2c2c;width: 80px;">
                                  {{strtoupper($value->job_id)}}
                                </td>
                                 <td style="padding-top: 4px;font-weight: 600;padding: 12px;border: 0;border-top: 1px solid #2c2c2c;">
                                   {{$value->product->name}}@if(isset($value->material)), {{$value->material}}@endif @if(isset($value->side)), {{$value->side}}@endif @if(isset($value->orientation)), {{$value->orientation}}@endif @if(isset($value->printing_side)), {{$value->printing_side}} @endif @if(isset($value->finishing_type)), {{$value->finishing_type}} @endif @if(isset($value->size)), {{$value->size}}@endif @if(isset($value->shape)), {{$value->shape}}@endif @if(isset($value->sleeve_color)), {{$value->sleeve_color}}@endif @if(isset($value->base)), {{$value->base}} @endif, x{{$value->orderdata->quantity}} 

                                @if($value->orderdata->printing_sample)<br> +6 printed samples @endif  @if($value->orderdata->sustainable_paper)<br> +printed on sustainable paper @endif
                                </td> 
                                <td style="padding-top: 4px;font-weight: 600;padding: 12px;border: 0;border-top: 1px solid #2c2c2c;">
                                   {{$value->orderdata->order_day}} Days
                                </td>
                                <td style="padding-top: 4px;font-weight: 600;padding: 12px;border: 0;border-top: 1px solid #2c2c2c;">
                                  {{$value->orderdata->quantity}}
                                </td> 
                                <?php 
                                  $org_price = $value->org_price; 
                                  $price = $value->org_price;
                                  if($value->orderdata->printing_sample) {
                                       $org_price =  $org_price + $value->orderdata->printing_sample;
                                       $price =  $price + $value->orderdata->printing_sample;
                                  } 
                                  if($value->orderdata->sustainable_paper) {
                                       $org_price =  $org_price + $value->orderdata->sustainable_paper;
                                       $price =  $price + $value->orderdata->sustainable_paper;
                                  }
                                  if($value->orderdata->vat) {

                                       $vat_price =  (int) $org_price * (int) $value->orderdata->vat;
                                       $vat_price =  $vat_price / 100;
                                       $org_price =  $org_price + $vat_price;
                                       /*$price = $price + $vat_price;*/
                                  }
                                ?>
                                <td style="padding-top: 4px;font-weight: 600;padding: 12px;border: 0;border-top: 1px solid #2c2c2c;">
                                    <?php if($value->orderdata->vat) {
                                             echo $value->orderdata->vat."%";
                                          }else{
                                               echo "N/A";
                                          }  
                                    ?>
                                </td>
                                <td style="padding-top: 4px;font-weight: 600;padding: 12px;border: 0;border-top: 1px solid #2c2c2c;">
                                   {{$value->symbol}}{{$price}}
                                </td> 
                                <td style="padding-top: 4px;font-weight: 600;padding: 12px;border: 0;border-top: 1px solid #2c2c2c;">
                                   {{$value->symbol}}{{$org_price}}
                                </td>
                                @php $total += $org_price; $symbol = $value->symbol; @endphp  
                            </tr> 
                            @endforeach  
                             
                             <tr style="background: #f2f2f2;">
                                 <td colspan="6" style="padding-top: 4px;padding: 12px;border: 0;border-top: 1px solid #2c2c2c;">
                                </td>
                                  <td style="padding-top: 4px;font-weight: 600;padding: 12px;border: 0;border-top: 1px solid #2c2c2c;text-align: right;">
                                   GRAND TOTAL:
                                </td>   
                                  <td style="padding-top: 4px;font-weight: 600;padding: 12px;border: 0;border-top: 1px solid #2c2c2c;">
                                   {{$symbol}}{{ $total }}
                                </td>                                 
                            </tr>                                                                                                                                                                                       
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>  
        <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" class="" style="max-width:750px;">
            <tr>
                <td style="padding:0px;" valign="top" align="center">
                    <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                        <tbody>
                            <tr>
                                <td style="padding-bottom: 14px;text-align: right;" valign="top">
                                    <a href="{{url('/')}}" style="background: #00e5cf!important;color: #fff;text-decoration: none;padding: 10px 10px; font-weight: 600;text-transform: uppercase;">Click to see Order</a>
                                </td>
                            </tr>                                               
                        </tbody>
                    </table>
                </td>
            </tr>
            <!--social links-->
                             <tr>
                                <td style="text-align: center;padding-bottom: 5px;color: #fff;" valign="top" align="center">
                                    <span><img src="http://122.160.12.75:3044/quinnstheprinters/public/vendor/avored-default/images/email_images/fb.png" style="max-width: 20px;width: 100%; padding: 10px;"><span>
                                    <span><img src="http://122.160.12.75:3044/quinnstheprinters/public/vendor/avored-default/images/email_images/twitter.png" style="max-width: 20px;width: 100%; padding: 10px;"><span>
                                    <span><img src="{{url('http://122.160.12.75:3044/quinnstheprinters/public/vendor/avored-default/images/email_images/linkedin-logo.png')}}" style="max-width: 20px;width: 100%; padding: 10px;"><span> 
                                    <span><img src="{{url('/public/vendor/avored-default/images/email_images/instagram.png')}}" style="max-width: 20px;width: 100%; padding: 10px;"><span>    
                                    <span><img src="{{url('/public/vendor/avored-default/images/email_images/youtube.png')}}" style="max-width: 20px;width: 100%; padding: 10px;"><span>                                                                                                                                                
                                </td>
                            </tr>              
        </table>

        <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" class="" style="max-width:750px;">
            <tr>
                <td style="padding:15px;" valign="top" bgcolor="#000" align="center">
                    <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                        <tbody>                          
                            <tr>
                                <td style="text-align: center;color: #fff;font-family: Arial,Helvetica,sans-serif;    font-size: 13px;" valign="top" align="center">COPYRIGHT2019. ALL RIGHTS RESEVED.</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>        
        
    </body>
</html>