<!-- BACK END PAGE FOR CSS ALTERING -->




    <table border="1" style="width:50%">
        <tr>
            <td>ID</td>
            <td>name</td>
            <td>desc</td>
            <td>active?</td>
            <td>snippet</td>
        </tr>
        <tr>
            <?php


            foreach($allCssInfo as $Css):
            ?>
            <td><?php echo $Css->getCSSID() ?></td>
            <td><?php echo $Css->getCSSName(); ?></td>
            <td><?php echo $Css->getCSSDescription(); ?></td>
            <td><?php echo $Css->getCSSIsActive(); ?></td>
            <td><?php echo $Css->getCSSSnippet(); ?></td>
        </tr>
<?php
endforeach;

?>