<?php
if (isset($tpl['status']))
{
	$status = __('status', true);
	switch ($tpl['status'])
	{
		case 2:
			//pjUtil::printNotice(NULL, $status[2]);
			break;
	}
} else {
	if (isset($_GET['err']))
	{
		$titles = __('error_titles', true);
		$bodies = __('error_bodies', true);
		//pjUtil::printNotice(@$titles[$_GET['err']], @$bodies[$_GET['err']]);
	}
	
	?>
	<div class="ui-tabs ui-widget ui-widget-content ui-corner-all b10">
		<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
			<li class="ui-state-default ui-corner-top"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminRoutes&amp;action=pjActionIndex"><?php __('menuRoutes'); ?></a></li>
				<?php
		if ($controller->isAdmin())
		{
			?>
			<li class="ui-state-default ui-corner-top"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminCities&amp;action=pjActionIndex"><?php __('lblCities'); ?></a></li>
				<?php } ?>
			<li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminBoarding&amp;action=pjActionIndex">Boarding/Drop-off</a></li>
		</ul>
	</div>
	<?php
	//pjUtil::printNotice(__('infoRoutesTitle', true, false), __('infoRoutesDesc', true, false)); 
	?>
	<div class="b10">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" class="float_left r5">
			<input type="hidden" name="controller" value="pjAdminBoarding" />
			<input type="hidden" name="action" value="pjActionCreate" />
			<input type="submit" class="pj-button" value="+ Add Boarding" />
		</form>
		<!--<form action="" method="get" class="float_left pj-form frm-filter">
			<input type="text" name="q" class="pj-form-field pj-form-field-search w150" placeholder="<?php // __('btnSearch', false, true); ?>" />
		</form>

<div class="float_right t5">
			<a href="#" class="pj-button btn-all"><?php //__('lblAll'); ?></a>
			<a href="#" class="pj-button btn-filter btn-status" data-column="status" data-value="T"><?php // echo $filter['active']; ?></a>
			<a href="#" class="pj-button btn-filter btn-status" data-column="status" data-value="F"><?php // echo $filter['inactive']; ?></a>
		</div>		-->
		<?php
		//$filter = __('filter', true);
		?>
		
		<br class="clear_both" />
	</div>

	<div id="grid"></div>
	<script type="text/javascript">
	var myLabel = myLabel || {};
	myLabel.city = "City";
	myLabel.opname = "Operator";
	

	</script>
	<?php
}
?>