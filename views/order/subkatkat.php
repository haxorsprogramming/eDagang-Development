<?php
//print_r($subcategoryrecord);
foreach($subcategoryrecord as $category)
{
	if($category->deleted_status!=1){
?>
<!-- Button trigger modal -->
	<div class="col-xs-6" style="padding-bottom:5px">
		<button type="button" class="btn btn-primary menu btn-block" data-toggle="modal" data-target="#prd-<?php echo $category->product_id;?>"><?php echo $category->product_name;?></button>
	</div>



<?php
	}
}
?>
