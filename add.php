<?php
	require_once 'lib.php';
	ob_start();
	head();
	if (!(isset($_POST["submit"]))||!($validate_data())) :
?>
<div id="product" class="default_wrap">
	<form name="assign1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
			method="post">
		<table>
			<caption class="error">All fields manadatory except "On Back Order"</caption>
			<tr>
				<th>Itemname:</th>
				<td><input name="itemName" type="text" value="<?php echo $itemName;?>"></td>
				<td class="error">* <?php echo $itemNameErr;?></td>
			</tr>
			<tr>
				<th>Description:</th>
				<td><textarea name="desc" cols="25" rows="4" placeholder="description"><?php echo $desc;?></textarea></td>
				<td class="error">* <?php echo $descErr;?></td>
			</tr>
			<tr>
				<th>Supplier Code:</th>
				<td><input name="spCode" type="text" value="<?php echo $spCode;?>"></td>
				<td class="error">* <?php echo $spCodeErr;?></td>
			</tr>
			<tr>
				<th>Cost:</th>
				<td><input name="cost" type="text" value="<?php echo $cost;?>"></td>
				<td class="error">* <?php echo $costErr;?></td>
			</tr>
			<tr>
				<th>Price:</th>
				<td><input name="price" type="text" value="<?php echo $price;?>"></td>
				<td class="error">* <?php echo $priceErr;?></td>
			</tr>
			<tr>
				<th>onHand:</th>
				<td><input name="onHand" type="text" value="<?php echo $onHand;?>"></td>
				<td class="error">* <?php echo $onHandErr;?></td>
			</tr>
			<tr>
				<td>Reorder Point:</td>
				<td><input name="reorderPoint" type="text" value="<?php echo $reorderPoint;?>"></td>
				<td class="error">* <?php echo $reorderPointErr;?></td>
			</tr>
			<tr>
				<td colspan="3">
					<input name="backOrder" type="checkbox" <?php if (isset($_POST['backOrder'])) echo "checked"?>>Back Order
				</td>
			</tr>
			<tr>
				<td colspan="3"><input name="submit" type="submit"></td>
			</tr>
		</table>
	</form>
</div>
<?php
	foot();
	else :
		$link = connect_db();

		$result=$link->query($choose_sql());
			if(!$result){
				echo "Error";
		}
		$link->close();
		echo "Processing ......";
		header('refresh:2; url=main.php');
		die();
	endif;
?>