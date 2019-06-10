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
// pjUtil::printNotice(__('infoAddRouteTitle', true, false), __('infoAddRouteDesc', true, false));
	
	$index = 'bs_' . rand(1, 999999); 
	?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminBoarding&amp;action=pjActionUpdate" method="post" id="frmCreateRoute" class="pj-form form">
		<input type="hidden" name="bording_update" value="1" />
		<input type="hidden" id="index_arr" name="index_arr" value="<?php echo $index;?>" />
		<?php if ((int) $tpl['option_arr']['o_multi_lang'] === 1 && count($tpl['lp_arr']) > 1) : ?>
		<div class="multilang b10"></div>
		<?php endif;?>
		<div class="clear_both">
			<?php
			foreach ($tpl['lp_arr'] as $v)
			{
			?>
				<p class="pj-multilang-wrap" data-index="<?php echo $v['id']; ?>" style="display: <?php echo (int) $v['is_default'] === 0 ? 'none' : NULL; ?>">
					<label class="title">City:</label>
						<span class="inline_block">
									<select name="city_id" class="pj-form-field w300 required bs-city">
										<option value="">-- <?php __('lblChoose'); ?>--</option>
										<?php
										foreach($tpl['city_arr'] as $k => $v)
										{
											if($_GET['id'] == $v['id']){
												$sel="selected";
											}
											else{
											$sel="";
											}
											?><option value="<?php echo $v['id'];?>" <?php echo $sel ?>><?php echo pjSanitize::clean($v['name']);?></option><?php
										} 
										?>
									</select>
								</span>
				</p>

				<?php 
			if($tpl['isEditor']){
				
					?>
					<input type="hidden" name="operator_id" value="<?php echo $_SESSION['admin_user']['id'] ?>" />
					<?php
			}
			else{
				
			?>
			<p>
				<label class="title">Operator:</label>
				<span class="inline_block" id="boxBusOperator">
					<select name="operator_id" id="operator_id" class="pj-form-field w250 required">
						<option value="">-- Operator --</option>
						<?php
						foreach ($tpl['Users'] as $v)
						{
							if($_GET['op'] == $v['id']){
							$sel="selected";
							}
							else{
						$sel="";
						}
							?><option value="<?php echo $v['id']; ?>" <?php echo $sel ?>><?php echo stripslashes($v['name']); ?></option><?php
						}
						?>
					</select>
				
				</span>
			</p>
			<?php } ?>
				<?php
			}
			if(isset($tpl['city_arr']) && count($tpl['city_arr']) > 0)
			{
				?>
				<div id="bs_location_list" class="bs-location-list">
					<?php
					if(isset($_GET['id']))
					{
						$i=1;
					foreach ($tpl['BoardingData'] as $Bord) {
						
						
						?>
						<div class="bs-location-row" data-index="<?php echo $index;?>">
							<p>
								<label class="title bs-title-<?php echo $index;?>">Boarding/Drop-off <?php echo $i ?>:</label>
							
								<span class="inline_block">
						<input type="text" name="boarding[]" value="<?php echo $Bord['boarding'] ?>" class="pj-form-field w300 required" lang="<?php echo $v['id']; ?>" />
						<?php if ((int) $tpl['option_arr']['o_multi_lang'] === 1 && count($tpl['lp_arr']) > 1) : ?>
						<span class="pj-multilang-input"><img src="<?php echo PJ_INSTALL_URL . PJ_FRAMEWORK_LIBS_PATH . 'pj/img/flags/' . $v['file']; ?>" alt="" /></span>
						<?php endif;?>
					</span>
							</p>
							<div class="location-icons">
								<a href="javascript:void(0);" class="location-delete-icon"></a>
								
							</div>
						</div>
						<?php
					$i++;
			}
		}
					?>
				</div>
				<p>
					<label class="title">&nbsp;</label>
					<input type="button" value="<?php __('btnAdd'); ?>" class="pj-button pj-add-location" />
				</p>
				<?php
			 
			}else{
				$label = __('lblCitiesPrompt', true, false);
				$label = str_replace("{STAG}",  '<a href="' . $_SERVER['PHP_SELF'] . '?controller=pjAdminCities&amp;action=pjActionUpdate">', $label);
				$label = str_replace("{ETAG}", '</a>', $label);
				?>
				<p>
					<label class="title">&nbsp;</label>
					<span class="inline_block">
						<label class="content"><?php echo $label;?></label>
					</span>
				</p>
				<?php
			} 
			?>
			<p>
				<label class="title">&nbsp;</label>
				<input type="submit" value="<?php __('btnSave'); ?>" class="pj-button" />
				<input type="button" value="<?php __('btnCancel'); ?>" class="pj-button" onclick="window.location.href='<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjAdminBoarding&action=pjActionIndex';" />
			</p>
		</div>
	</form>
	
	<div id="bs_location_clone" style="display:none;">
		<div class="bs-location-row" data-index="{INDEX}">
			<p>
				<label class="title bs-title-{INDEX}">Boarding/Drop-off  {ORDER}:</label>
				<span class="inline_block">
					<input type="text" name="boarding[]" class="pj-form-field w300 required bs-city">
						
					
				</span>
			</p>
			<div class="location-icons">
				<a href="javascript:void(0);" class="location-delete-icon"></a>
				
			</div>
		</div>
	</div>
	<div id="dialogPrompt" title="<?php __('lblSameLocation'); ?>" style="display:none">
		<p><?php __('lblSameLocationText'); ?></p>
	</div>
	<script type="text/javascript">
	var locale_array = new Array(); 
	var myLabel = myLabel || {};
	myLabel.field_required = "<?php __('bs_field_required'); ?>";
	myLabel.location = "<?php __('lblLocation'); ?>";
	<?php
	foreach ($tpl['lp_arr'] as $v)
	{
		?>locale_array.push(<?php echo $v['id'];?>);<?php
	} 
	?>
	myLabel.locale_array = locale_array;
	myLabel.localeId = "<?php echo $controller->getLocaleId(); ?>";
	myLabel.number_of_cities = <?php echo count($tpl['city_arr']); ?>;
	(function ($) {
		$(function() {
			$(".multilang").multilang({
				langs: <?php echo $tpl['locale_str']; ?>,
				flagPath: "<?php echo PJ_FRAMEWORK_LIBS_PATH; ?>pj/img/flags/",
				select: function (event, ui) {
					
				}
			});
		});
	})(jQuery_1_8_2);
	</script>
	<?php
}
?>