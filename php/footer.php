<!-- Data for Footer Pages of index.php -->

<div class="footer">
<table>
	<tr>
		<td></td>
		<td>	
		<?php 
			if($page <= 1){
				echo "First";
			} else {
				echo "<a href='index.php?page=";
				echo 1;
				echo "'>First</a>";
			}
		?>
		</td>
		<td>
		<?php
	    	if($page <= 1){
				echo 'Prev';
		 	} else {
				echo "<a href='index.php?page=";
				echo $page-1;
				echo "'>Prev</a>";
		 	}
		?>
		</td>
		<td>
		<?php
			if($page >= $totalpages){
				echo 'Next';
			} else {
				echo "<a href='index.php?page=";
				echo $page+1;
				echo "'>Next</a>";
			}
		?>
		</td>
		<td>
		<?php
			if($page >= $totalpages){
				echo 'Last';
			} else {
				echo "<a href='index.php?page=";
				echo $totalpages;
				echo "'>Last</a>";
			}
		?>
		<td></td>
</table>
</div>