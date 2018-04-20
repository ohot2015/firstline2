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

 $rs = @mail( 'ohot2015@gmail.com' , 'первая линия' , $tempalte );
echo json_encode($rs);
?>
