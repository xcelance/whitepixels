
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" class="" style="max-width:750px;">
            <tr>
                <td style="padding:10px;" class="em_padd" valign="top" bgcolor="#000" align="center">
                    <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                        <tbody>
                            <tr>
                                <td style="text-align: center;" valign="top" align="center"><img src="{{url('/public/vendor/avored-default/images/mail-site-logo.png')}}" alt="" width="110px"></td>
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
                                   Quotation Product
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
                            <tr>
                                 <td style="padding-top: 4px; font-weight: 600;padding: 12px;border: 0;border-top: 1px solid #2c2c2c;">
                                  1
                                </td>
                                <td style="padding-top: 4px; font-weight: 600;padding: 12px;border: 0;border-top: 1px solid #2c2c2c;width: 85px;">
                                  {{$quote->job_id}}
                                </td>
                                 <td style="padding-top: 4px;font-weight: 600;padding: 12px;border: 0;border-top: 1px solid #2c2c2c;">
                                   {{$quote->product->name}}({{$quote->category->name}}),{{$quote->orderdata->size}},{{$quote->orderdata->colors}},{{$quote->orderdata->pages}},{{$quote->orderdata->finishing_req}},{{$quote->orderdata->papertype}},({{$quotesinfo->quotesdata->quote_tat}}Days TAT),x{{$quotesinfo->quotesdata->quote_quantity}}
                                </td> 
                                <td style="padding-top: 4px;font-weight: 600;padding: 12px;border: 0;border-top: 1px solid #2c2c2c;">
                                   {{$quotesinfo->quotesdata->quote_tat}} Days
                                </td>
                                <td style="padding-top: 4px;font-weight: 600;padding: 12px;border: 0;border-top: 1px solid #2c2c2c;">
                                  {{$quotesinfo->quotesdata->quote_quantity}}
                                </td> 
                              
                                <td style="padding-top: 4px;font-weight: 600;padding: 12px;border: 0;border-top: 1px solid #2c2c2c;">N/A
                                </td>
                                <td style="padding-top: 4px;font-weight: 600;padding: 12px;border: 0;border-top: 1px solid #2c2c2c;">
                                 @if($quotesinfo->quotesdata->quote_currency == 'GBP')£@else€@endif{{$quotesinfo->quotesdata->quote_price}}
                                </td> 
                                <td style="padding-top: 4px;font-weight: 600;padding: 12px;border: 0;border-top: 1px solid #2c2c2c;">
                                   @if($quotesinfo->quotesdata->quote_currency == 'GBP')£@else€@endif{{$quotesinfo->quotesdata->quote_price}}
                                </td> 
                            </tr> 
                             <tr style="background: #f2f2f2;">
                                 <td colspan="6" style="padding-top: 4px;padding: 12px;border: 0;border-top: 1px solid #2c2c2c;">
                                </td>
                                  <td style="padding-top: 4px;font-weight: 600;padding: 12px;border: 0;border-top: 1px solid #2c2c2c;text-align: right;">
                                   GRAND TOTAL:
                                </td>   
                                  <td style="padding-top: 4px;font-weight: 600;padding: 12px;border: 0;border-top: 1px solid #2c2c2c;">
                                   @if($quotesinfo->quotesdata->quote_currency == 'GBP')£@else€@endif{{$quotesinfo->quotesdata->quote_price}}
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
        </table>
        
        
    </body>
</html>