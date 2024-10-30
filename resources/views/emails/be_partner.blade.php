


@extends('layouts.mail')


@section('content')

    <tr>
                                    <td valign="top">
                                        <!-- BEGIN MODULE: Order Summary -->
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                            role="presentation">
                                            <tr>
                                                <td class="pc-w620-spacing-0-0-0-0" style="padding: 0px 0px 0px 0px;">
                                                    <table width="100%" border="0" cellspacing="0"
                                                        cellpadding="0" role="presentation">
                                                        <tr>
                                                            <td valign="top"
                                                                class="pc-w620-radius-10-10-10-10 pc-w620-padding-32-24-32-24"
                                                                style="padding: 40px 24px 40px 24px; border-radius: 20px 20px 20px 20px; background-color: #ecf1fb;"
                                                                bgcolor="#ecf1fb">
                                                                <table width="100%" border="0" cellpadding="0"
                                                                    cellspacing="0" role="presentation">
                                                                    <tr>
                                                                        <td class="pc-w620-spacing-0-0-0-0"
                                                                            align="center" valign="top"
                                                                            style="padding: 0px 0px 8px 0px;">
                                                                            <table border="0" cellpadding="0"
                                                                                cellspacing="0" role="presentation"
                                                                                width="100%"
                                                                                style="border-collapse: separate; border-spacing: 0; margin-right: auto; margin-left: auto;">
                                                                                <tr>
                                                                                    <td valign="top"
                                                                                        class="pc-w620-padding-0-0-0-0"
                                                                                        align="center">
                                                                                        <div class="pc-font-alt pc-w620-fontSize-24px pc-w620-lineHeight-40"
                                                                                            style="line-height: 100%; letter-spacing: -0.03em; font-family: 'Poppins', Arial, Helvetica, sans-serif; font-size: 24px; font-weight: 600; font-variant-ligatures: normal; color: #001942; text-align: center; text-align-last: center;">
                                                                                            <div><span>Partnership Form</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                          
                                                                <table width="100%" border="0" cellpadding="0"
                                                                    cellspacing="0" role="presentation">
                                                                    <tr>
                                                                        <td style="padding: 0px 0px 4px 0px; ">
                                                                            <table cellpadding="3" cellspacing="0" style="width:600px;border-bottom:1px solid #ccc;border-right:1px solid #ccc">
                                                                                <tbody>
                                                                                    <tr valign="top">
                                                                                        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">Full Name</td>
                                                                                        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">{{$data['name']}}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr valign="top">
                                                                                        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">Email</td>
                                                                                        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d"><a
                                                                                                href="mailto:{{$data['email']}}" target="_blank">{{$data['email']}}</a></td>
                                                                                    </tr>
                                                                                    <tr valign="top">
                                                                                        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">Phone</td>
                                                                                        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">{{$data['phone']}}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr valign="top">
                                                                                        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">Street Address
                                                                                        </td>
                                                                                        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">{{$data['address']}}</td>
                                                                                    </tr>
                                                                                    <tr valign="top">
                                                                                        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">City</td>
                                                                                        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">{{$data['city']}}</td>
                                                                                    </tr>
                                                                                    <tr valign="top">
                                                                                        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">State / Province
                                                                                            / Region</td>
                                                                                        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">{{$data['state']}}</td>
                                                                                    </tr>
                                                                                    <tr valign="top">
                                                                                        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">Postal / Zip
                                                                                            Code</td>
                                                                                        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">{{$data['zip']}}</td>
                                                                                    </tr>
                                                                                    <tr valign="top">
                                                                                        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">Country</td>
                                                                                        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">{{$data['country']}}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr valign="top">
                                                                                        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">How did you hear
                                                                                            about us?</td>
                                                                                        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">{{$data['hear_about_us']}}</td>
                                                                                    </tr>
                                                                                    <tr valign="top">
                                                                                        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">Business Type
                                                                                        </td>
                                                                                        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">{{$data['business_type']}}</td>
                                                                                    </tr>
                                                                                    <tr valign="top">
                                                                                        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">Provide Your
                                                                                            Business
                                                                                            Proposal</td>
                                                                                        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">
                                                                                        {!!$data['proposal']!!}
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                             
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <!-- END MODULE: Order Summary -->
                                    </td>
                                </tr>
@endsection