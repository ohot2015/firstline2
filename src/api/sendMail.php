<?php
$name = $_REQUEST['name'];
$phone = $_REQUEST['phone'];
$r_id = $_REQUEST['rId'];

$tempalte = <<<END
    <table>
        <tr>
            <td>
            Оставленна заявка на броьнь квартиры №
            </td>
            <td>$r_id</td>
        </tr>
        <tr>
            <td>Имя:</td>
            <td>$name</td>
        </tr>
        <tr>
            <td>Телефон:</td>
            <td>$phone</td>
        </tr>
    </table>
END;

 $rs = @mail( 'ohot2015@gmail.com' , 'первая линия' , $tempalte, "From: banel1ng@yahoo.com\r\n"
    ."Content-type: text/html; charset=utf-8\r\n"
    ."X-Mailer: PHP mail script" );
echo json_encode($rs);
?>
