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

 $rs = @mail( 'info@line12.ru' , 'Первая линия' , $tempalte, "From:noreply@line12.ru\r\n"
    ."Content-type: text/html; charset=utf-8\r\n"
    ."X-Mailer: PHP mail script" );
echo json_encode($rs);
?>
