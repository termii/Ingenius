<?php header('Content-type: text/html; charset=utf-8'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="Generator" content="Microsoft Word 11 (filtered medium)" />
    <title></title>
</head>
<body style="font-family:Tahoma,'Trebuchet MS',Verdana;font-size:16px;margin:0px;background:#fcfcfc;color:#FFF;text-align:center;">

<table width="100%" align="center">
        <tr>
            <td height="10px" align="center" style="font-size:24px;color:#35bac3;padding-bottom:10px;">
                &nbsp;&nbsp;
            </td>
        </tr>
        <tr>
            <td height="10px" align="center" style="font-size:26px;color:#ce1417;padding-top:10px;font-weight:bold;">
                <?php echo $this->option_model->get_value('appname'); ?>
            </td>
        </tr>
        <tr>
            <td height="10px" align="center" style="font-size:24px;color:#35bac3;padding-bottom:10px;">
                &nbsp;&nbsp;
            </td>
        </tr>
        <tr>
            <td height="10px" align="center" style="font-size:24px;color:#888888;padding-bottom:10px;">
                &nbsp;&nbsp;Recover Your Password
            </td>
        </tr>
</table>

    <div style="line-height:20px;width:100%;text-align:center;font-size:16px;">
        <p style="color:#0D2213;">Please follow the link below to recover your password</p>
         <?php foreach($contact as $con):?>
            <a style="color:#0D2213;" href="<?php echo base_url(); ?>user/recmail/<?php echo utf8_encode($con['user_id']); ?>/<?php echo utf8_encode($con['user_passrecover']); ?>">Click here</a>
        <?php endforeach;?>
    </div>
<p>&nbsp;</p>
</body>
</html>