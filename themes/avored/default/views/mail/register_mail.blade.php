<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
        a{
            color:#00e5cf !important;
                text-decoration: none;
        }
               @media screen and (max-width:480px){
                .login-table {
                    padding: 10px 10px !important;
                }
                }

               @media screen and (max-width:420px){
                .login-table {
                    padding: 10px 10px !important;
                    font-size: 12px !important;
                }  
                .login-feild span {
                  padding-left: 3px !important;
                 }   
                 .login-btn .bg-div {
                    background-size: 86% !important;
                        height: 35px!important;
                }     
                .login-text {
                    padding: 10px 26px 0px 38px !important;
                }                  

               } 

                @media screen and (max-width:320px){
                    .login-feild {
                        display: block;
                        width: 100%;
                       text-align: center !important;         
                    }
                    .login-btn{
                        display: block;
                        width: 100%;
                        text-align: center !important;
                    }

               }               

        </style>
    </head>
    <body style="background: #e6e5e5">
        <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" class="" style="max-width:600px;">
            <tr>
                <td style="padding:10px;border-top-left-radius: 3px;border-top-right-radius: 3px;" valign="top" bgcolor="#000" align="center">
                    <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                        <tbody>
                            <tr>
                                <td style="text-align: center;" valign="top" align="center"><img src="{{url('/public/vendor/avored-default/images/email_images/site-logo.png')}}" alt="" width="110px"></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
        <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" class="" style="max-width:600px;    background: #fff;font-family:Arial,Helvetica,sans-serif;padding-right: 10px;padding-left: 10px;">
            <tr>
                <td style=" padding-bottom: 12px;" valign="top" align="center">
                 <!--welcome sec-->
                    <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" 
                       style="max-width:550px;">
                        <tbody>
                            <tr><td style="height:20px;"></td></tr>

                            <tr>
                                <td style="text-align: center;">
                                    <img src="{{url('/public/vendor/avored-default/images/email_images/welcome.png')}}" style="max-width: 600px;width: 100%;">
                                </td>
                            </tr>
                            <tr><td style="height:20px;"></td></tr>

                            <tr>
                                <td align="center" valign="middle" height="30">
                                <span style="font-size:18px;color:#00e5cf">Welcome to White Pixels,
                                 <br>
                                 <b>{{$username}}</b>
                                 </span>
                                </td>
                             </tr>  
                            <tr><td style="height:20px;"></td></tr>

                             <tr>
                              <td align="center" valign="top" style="font-size: 15px;color: #333333;">Thank you for choosing us to be your printing partner.</td>
                             </tr> 

                             <tr>
                              <td align="center" valign="top" style="font-size: 15px;color: #333333;">Please find your user login details below.</td>
                             </tr> 
                             <tr><td style="height:20px;"></td></tr>

                        </tbody>
                    </table>
                      <!--form sec-->                  
                    <table class="login-table" bgcolor="#F7F7F7" border="0" cellpadding="0" cellspacing="0" style="margin:0;padding:10px 30px;font-family:Arial,Helvetica,sans-serif;font-size:14px;color:#333333;background: #f2f2f2;    border: 1px solid #efe9e9;max-width:550px;" width="100%">
                        <tbody>
                            <tr>
                                <td width="60px" class="login-feild"><b>Login:</b><span style="padding-left: 10px;">{{$username}}</span></td>
                                <td width="90px" class="login-feild"><b>Password:</b><span style="padding-left: 10px;">{{$password}}</span></td>
                                <td class="login-btn" style="font-size:14px;color:#ccc;text-align: right;" valign="middle" width="104">
                                    <a href="{{url('/')}}" style="color:#333333;display:inline-block!important;padding:0;border:none;margin-top:10px;margin-bottom:10px">
                                    <div class="bg-div" style="background:url({{url('/public/vendor/avored-default/images/email_images/login-btn.png')}});height:40px!important;width:104px!important;display:block!important;background-repeat:no-repeat;color:#fff!important">
                                        <div class="login-text" style="display:inline-block; padding: 13px 13px 10px 47px;line-height:13px!important; font-weight: 600;">
                                            Login
                                        </div>
                                    </div></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!--get offrr sec-->
                     <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" 
                       style="max-width:550px;">
                        <tbody>
                            <tr><td style="height:20px;"></td></tr>  
                             <tr>
                              <td align="center" valign="top" style="font-size: 15px;color: #333333;">To get you started we would like to offer you <span style="color:#00e5cf;"><b>10% off</b></span> you first order.</td>
                             </tr> 
                            <tr><td style="height:20px;"></td></tr>
                             <tr>
                              <td align="center" valign="top" style="font-size: 15px;color: #333333;">If you would like to call us<br> on <b>028 9032 3552</b> to claim your <b>10% off code.</b></td>
                             </tr> 
                             <tr><td style="height:20px;"></td></tr> 
                             <tr><td style="height:20px;"></td></tr>
                             <tr>
                              <td align="center" valign="top" style="font-size: 18px;color: #333333;">5 reasons you will benefit using whitepixels.net: </td>
                             </tr>
                        </tbody>
                    </table>  
                     <!--benefits sec-->
                     <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" 
                       style="max-width:530px;  font-size: 12px;    color: #000;">
                        <tbody>
                             <tr><td style="height:20px;"></td></tr>                                                        
                            <tr>
                                 <td>
                                    <img src="{{url('/public/vendor/avored-default/images/icon1.png')}}" class="CToWUd">
                                 </td>
                                   <td style="text-align:left;padding-left:5px;margin-bottom:20px">OUTSTANDING<br> TURNAROUND TIME</td>
                                 <td>
                                    <img src="{{url('/public/vendor/avored-default/images/icon2.png')}}" class="CToWUd">
                                 </td>
                                  <td style="text-align:left;padding-left:5px">HIGH QUALITY<br> PRINT FINISHING</td>
                             </tr> 

                               <tr><td style="height:20px;"></td></tr> 

                            <tr>
                                 <td>
                                    <img src="{{url('/public/vendor/avored-default/images/icon3.png')}}" class="CToWUd">
                                 </td>
                                   <td style="text-align:left;padding-left:5px;margin-bottom:20px">EXCELLENT FULL<br> COLOUR PRINTING</td>
                                 <td>
                                    <img src="{{url('/public/vendor/avored-default/images/icon4.png')}}" class="CToWUd">
                                 </td>
                                  <td style="text-align:left;padding-left:5px">INDUSTRY<br> COMPETITIVE PRICING</td>
                             </tr> 

                              <tr><td style="height:20px;"></td></tr>

                            <tr>
                                 <td>
                                    <img src="http://122.160.12.75:3044/quinnstheprinters/public/vendor/avored-default/images/icon5.png" class="CToWUd">
                                 </td>
                                   <td style="text-align:left;padding-left:5px;margin-bottom:20px">FREE DELIVERY TO ANYWHERE<br> IN THE UK AND IRELAND</td>
                             </tr>                                                             
                             <tr><td style="height:20px;"></td></tr>
                             <tr><td style="height:20px;"></td></tr>   
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
        
        <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" class="" style="max-width:600px;">
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