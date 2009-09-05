<?php include "header_inc.php" ?>

<div id="centerDiv">
<div class="newsBg">
<?php
$archive = new Archive("new","Nyhetsregister");
$archive->showActual();
$archive->showMonth();
$archive->showAll();

?>
</div>
</div>
<?php include "footer.php" ?>
