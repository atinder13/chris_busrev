<?php
if (isset($tpl['status']))
{
	$status = __('status', true);
	switch ($tpl['status'])
	{
		case 2:
			pjUtil::printNotice(NULL, $status[2]);
			break;
	}
} else {
	
	//pjUtil::printNotice(__('infoAddBusTypeTitle', true, false), __('infoAddBusTypeDesc', true, false));
	?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminBoarding&amp;action=pjActionCreateSlide" method="post" id="frmCreateBusType" class="pj-form form" enctype="multipart/form-data">
		<input type="hidden" name="bus_type_create" value="1" />
		
		<div class="clear_both">
		
			
			
			<input type="hidden" name="operator_id" value="<?php echo $_SESSION['admin_user']['id'] ?>" />
			<input type="hidden" name="slide_create" value="1" />
					
			
		
			
			<p>
				<label class="title">Slide</label>
				<span class="inline_block">
					<input type="file" name="filepic" id="filepic" class="pj-form-field" />
				</span>
			</p>
			<?php 
			
				if(count($tpl['slidearr']) > 0 ){
				
					 $file3 = FRONTURL."img/slides/";
					 $file=$tpl['slidearr']['slide'];
					 
					?>
					<img src="<?php echo $file3.$file  ?>" style="width:300px;height:150px">
					<?php
				}
			?>
			<br>
			<p>
				<label class="title">&nbsp;</label>
				<input type="submit" value="<?php __('btnSave'); ?>" class="pj-button" />
				
			</p>
		</div>
	</form>

	<?php
}
?>