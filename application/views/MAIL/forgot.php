<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600,300' rel='stylesheet' type='text/css'>
<table width="614" border="0" align="center" cellpadding="0" cellspacing="0" style="font-family:'Open Sans',Arial,Helvetica,sans-serif;font-size:12px;color:#656565;background: #FDFDFD;border: 1px solid #D6D5D5;-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;-webkit-box-shadow: 0px -1px 5px #DDD;-moz-box-shadow: 0px -1px 3px #DDD;box-shadow: 0px -1px 5px #DDD;width: 168px;">
    <tbody>
        <tr>
            <td style="border-radius: 8px 8px 0 0; position: relative; text-align:center;">
                <a href="javascript:;">
                    <img src="<?=base_url().'/uploads/emaillogo.png'?>" alt="CHAWDAWN" width="100" height="100" border="0" style="padding:10px;">
                </a>
            </td>
        </tr>
        <tr>
            <td style="padding:0 18px 10px; background: #eee;">
                <table width="576" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#656565">
                    <tbody>
                        <tr>
                            <td style="font-family:'Open Sans',Arial,Helvetica,sans-serif;font-weight:600;font-size:15px;padding:10px 0 10px">Welcome,</td>
                        </tr>
                    </tbody>
                </table>

                <table width="576" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#656565">
                    <tbody>
                        <tr>
                            <td style="padding:0 10px 20px 10px;">
                                <table width="554" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div style="font-family:'Open Sans',Arial,Helvetica,sans-serif; font-size: 14px; color: #6C6C6C;">
                                                    Dear<span><?php echo " $email, </span><br><br>We have received a request of forgot the password. Please click on the below link to Reset your password"; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>        
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table width="576" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#252525;padding:10px">
                    <tbody>
                        <tr>
                            <td width="100">
                                <div style="font-family:'Open Sans',Arial,Helvetica,sans-serif; font-size: 14px; color: #252525;">
                                    <?php echo 'Click here : '; ?>
                                </div>
                            </td>
                            <td>
                                <div style="font-family:'Open Sans',Arial,Helvetica,sans-serif; font-size: 14px; color: #252525;">
                                    <a href="<?=$link?>" target="_blank" >Reset Password</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>


                <table width="576" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#252525">
                    <tbody>
                        <tr>
                            <td style="padding:0 10px 20px 10px;">
                                <table width="554" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div style="font-family:'Open Sans',Arial,Helvetica,sans-serif; font-size: 14px; color: #6C6C6C;">
                                                    <?php //echo $html; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>        
                            </td>
                        </tr>
                        <tr>
                            <td style="font-family:'Open Sans',Arial,Helvetica,sans-serif;font-size:14px;padding:10px;border-top:1px solid #d3dde2;">
                                Sincerely,<br /> The ABC APP Team.
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table width="576" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#252525">
                    <tbody>
                        <tr>
                            <td style="padding:0 10px 20px 10px;">
                                <table width="554" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div style="font-family:'Open Sans',Arial,Helvetica,sans-serif; font-size: 14px; color: #6C6C6C;">
                                                    <?php //echo $html; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>        
                            </td>
                        </tr>
                        <tr>
                            <td style="font-family:'Open Sans',Arial,Helvetica,sans-serif;font-size:14px;padding:10px;border-top:1px solid #d3dde2;">
                                <p style="text-align: justify">
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </td>
        </tr>
        <tr>
            <td style="font-family:'Open Sans',Arial,Helvetica,sans-serif; font-size:11px; line-height:16px; padding:15px 18px; text-align:center; border-radius: 0 0 8px 8px; background-color: #ffa237; color: #fff;">
            </td>
        </tr>
    </tbody>
</table>