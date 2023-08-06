<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Statement</title>
  </head>
  <body>
    <head>
      <style type="text/css">
        @import url(https://fonts.googleapis.com/css?family=Roboto:400,300,500,700,700italic,900);
        body { font-family: 'Roboto', Arial, sans-serif !important; }
        a[href^="tel"]{
        color:inherit;
        text-decoration:none;
        outline:0;
        }
        a:hover, a:active, a:focus{
        outline:0;
        }
        a:visited{
        color:#FFF;
        }
        span.MsoHyperlink {
        mso-style-priority:99;
        color:inherit;
        }
        span.MsoHyperlinkFollowed {
        mso-style-priority:99;
        color:inherit;
        }
      </style>
    </head>
    <body style="margin: 0; padding: 0;background-color:#EEEEEE;">
      
      <table cellspacing="0" style="margin:0 auto; width:100%; border-collapse:collapse; background-color:#EEEEEE; font-family:'Roboto', Arial !important">
        <tbody>
          <tr>
            <td align="center" style="padding:20px 23px 0 23px">
              <table width="600" style="background-color:#FFF; margin:0 auto; border-radius:0px; border-spacing: 0;">
                <tbody>
                  <tr>
                    <td align="center">
                      <table width="500" style="margin:0 auto">
                        <tbody>
                          <tr>
                            <td align="center" style="padding:40px 0 35px 0"><a href="#" target="_blank" style="color:#128ced; text-decoration:none;outline:0;">
                            @if($setting->file_path_squre!='')  
                              <img alt="" src="{{ $setting->file_url }}" border="0" style="max-width: 250px;width: 100%; ">
                            @else
                              <img alt="" src="{{url('backend/images/logo-full.png')}}" border="0" style="max-width: 250px;width: 100%; ">
                            @endif
                            </a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                  
                  <tr>
                    <td align="center" cellspacing="0" style="padding:0; vertical-align:middle">
                    <table width="550" style="border-collapse:collapse; background-color:#FaFaFa; margin:0 auto; border-bottom:1px solid #E5E5E5">
                        <tbody>
                          <tr>
                          <td width="60" align="right" style="font-family:'Roboto', Arial !important">
                              <p style="margin:0; font-size:14px; color:#333333;padding:0;font-family:'Roboto', Arial !important;text-align:center;">
                                Purpose
                              </p>
                            </td>
                            <td width="60" align="right" style="font-family:'Roboto', Arial !important">
                              <p style="margin:0; font-size:14px; color:#333333;padding:0;font-family:'Roboto', Arial !important;text-align:center;">
                                Cr Amount
                              </p>
                            </td>
                            <td width="60" align="right" style="font-family:'Roboto', Arial !important">
                              <p style="margin:0; font-size:14px; color:#333333;padding:0;font-family:'Roboto', Arial !important;text-align:center;">
                                Dr Amount
                              </p>
                            </td>
                            <td width="60" align="right" style="font-family:'Roboto', Arial !important">
                              <p style="margin:0; font-size:14px; color:#333333;padding:0;font-family:'Roboto', Arial !important;text-align:center;">
                              Current Balance
                              </p>
                            </td>
                            
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                  @foreach($datums as $data)
                  <tr>
                    <td style=" font-family:'Roboto', Arial !important;padding:0; background: #fff;" align="center">
                      <table width="550" style="border-collapse:collapse;margin: 0 auto;border-bottom: 1px solid #EBEBEB">
                        <tbody>
                          <tr>
                            
                            <td width="80" style="vertical-align:top; padding:10px 0 0 10px; font-family:'Roboto', Arial !important;">
                              
                              <p style="font-size:13px; margin:0; color:#212121; line-height:12px; font-family:'Roboto', Arial !important;font-weight: 400;">
                                <small>{{$data->purpose}}</small>
                              </p>
                            </td>
                            <td align="center" width="50" style="vertical-align:middle; font-family:'Roboto', Arial !important;padding:0;">
                              <p style="font-size:16px; color:#212121; margin:0; font-family:'Roboto', Arial !important;text-align:center;">
                                {{$data->credit_amount}}
                              </p>
                            </td>
                            <td align="center" width="50" style="vertical-align:middle; font-family:'Roboto', Arial !important;padding:0;">
                              <p style="font-size:16px; color:#212121; margin:0; font-family:'Roboto', Arial !important;text-align:center;">
                              {{$data->debit_amount}}
                              </p>
                            </td>
                            <td align="center" width="80" style="vertical-align:middle; font-family:'Roboto', Arial !important;padding:0;">
                              <p style="font-size:16px; color:#212121; margin:0; font-family:'Roboto', Arial !important;text-align:center;">
                              {{$data->current_balance}}
                              </p>
                            </td>
                            
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                  @endforeach
                  
                </tbody>
              </table>
            </td>
          </tr>
        </tbody>
      </table>
  </body>
  </body>
</html>