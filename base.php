<?php
include("header.php");
?>

<body>
	<?php echo "<p>". print_r($user_data) ."</p>"; ?>
	
	<p>test</p>
	<button>coucou</button></br>
	<a href = "loggout.php">Logout</a></br>
	<label>label</label></br>
	<input type = "text" value = "test"/></br>
	<input type = "text"  value = "test"/>
	<input type = "text"  value = "test"/></br>
	<textarea>textarea</textarea></br>
	
	<table>
		<tr>
		<th>Company</th>
		<th>Contact</th>
		<th>Country</th>
		</tr>
		<tr>
		<td>Alfreds Futterkiste</td>
		<td>Maria Anders</td>
		<td>Germany</td>
		</tr>
		<tr>
		<td>Berglunds snabbköp</td>
		<td>Christina Berglund</td>
		<td>Sweden</td>
		</tr>
	</table>
	
</body>

<?php
include("footer.php");
?>