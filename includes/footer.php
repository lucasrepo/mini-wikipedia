
	<form action="/scripts/save.php" method="post">
		
		<textarea 
			name="t-area" 
			rows="40" 
			cols="100" 
			autofocus><?php echo $_SESSION['information'] ?></textarea><br>
		
		<input
			type="text"
			name="name" 
			class="name-input" 
			<?php echo value($_SESSION['name'])?>>

		<input type="submit" name="load" value="Load">
		<input type="submit" name="save" value="Save">
		<input type="submit" name="new" value="New">
	
	</form>
</body>
</html>