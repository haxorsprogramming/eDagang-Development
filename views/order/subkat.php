<?php
//print_r($subcategoryrecord);
foreach($subcategoryrecord as $category)
{
?>
<!-- Button trigger modal -->
<div class="col-xs-6" style="padding-bottom:5px">
				<button type="button" class="btn btn-primary menu btn-block" id="subkat<?php echo $category->category_id;?>"><?php echo $category->product_category_name;?></button>
	</div>

	<script>
	 $('#subkat<?php echo $category->category_id;?>').click(function(e){
		$('#divsubkatkat').html("...............loading.........");
		$('#divsubkatkat').load('<?=base_url()?>order/subkatkat/<?php echo $category->category_id;?>');
		//$('#divmodal').load('<?=base_url()?>order/modalava');
		return false;
	});
</script>

<?php
}
?>
