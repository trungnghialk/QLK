<div class="clearfix">
	<div class="hint-text">Từ <b><?php echo $start+1 ?></b> đến <b><?php echo $start+$record_per_page ?></b> trong <b> <?php echo $total_record ?></b> phiếu</div>
	<ul class="pagination">
		<li class="page-item disabled"><a href="#">Previous</a></li>
		<?php 
		for( $i = 1; $i<= $total_page; $i++){
			if(!isset($page)){$page = 1;}
			if($i == $page){
				echo ('<li class="page-item active""><a href="'.$url.$i.'" class="page-link">'.$i.'</a></li>');
			}
			else {
				echo ('<li class="page-item"><a href="'.$url.$i.'" class="page-link">'.$i.'</a></li>');
			}
		}
		?>
		<li class="page-item"><a href="#" class="page-link">Next</a></li>
	</ul>
</div>