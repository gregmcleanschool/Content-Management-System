
<nav>
    <ul>
        <?php
        foreach ($pageArray as $page)
        {


                $currentName = $page->getName();
                $currentAlias = $page->getAlias();




                echo "<li>";
                echo "<a href=indexFrontEnd.php?page=$currentAlias>$currentName</a>";
                echo "</li>";


        }
        ?>
    </ul>
</nav>