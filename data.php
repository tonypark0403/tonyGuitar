<div id="product" class="default_wrap">
<?php
    require_once 'lib.php';
    $link = connect_db();
	$result = $link->query($choose_sql());
	select_sql($result);
	$link->close();
?>
</div> <!-- #product -->