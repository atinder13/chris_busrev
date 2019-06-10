<style type="text/css">
	ul {
  list-style-type: none;
}

li {
  display: inline-block;
}

input[type="radio"][id^="cb"] {
  display: none;
}

label {
  border: 1px solid #fff;
  padding: 10px;
  display: block;
  position: relative;
  margin: 10px;
  cursor: pointer;
}

label:before {
  background-color: white;
  color: white;
  content: " ";
  display: block;
  border-radius: 50%;
  border: 1px solid grey;
  position: absolute;
  top: -5px;
  left: -5px;
  width: 25px;
  height: 25px;
  text-align: center;
  line-height: 28px;
  transition-duration: 0.4s;
  transform: scale(0);
}

label img {
  height: 100px;
  width: 100px;
  transition-duration: 0.2s;
  transform-origin: 50% 50%;
}

:checked + label {
  border-color: #ddd;
}

:checked + label:before {
  content: "✓";
  background-color: grey;
  transform: scale(1);
}

:checked + label img {
  transform: scale(0.9);
  box-shadow: 0 0 5px #333;
  z-index: -1;
}
</style>
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
	
	pjUtil::printNotice(__('infoAddBusTypeTitle', true, false), __('infoAddBusTypeDesc', true, false));
	?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminBusTypes&amp;action=pjActionCreate" method="post" id="frmCreateBusType" class="pj-form form" enctype="multipart/form-data">
		<input type="hidden" name="bus_type_create" value="1" />
		<?php if ((int) $tpl['option_arr']['o_multi_lang'] === 1 && count($tpl['lp_arr']) > 1) : ?>
		<div class="multilangb b10"></div>
		<?php endif;?>
		<div class="clear_both">
			<?php
			foreach ($tpl['lp_arr'] as $v)
			{
			?>
				<p class="pj-multilang-wrap" data-index="<?php echo $v['id']; ?>" style="display: <?php echo (int) $v['is_default'] === 0 ? 'none' : NULL; ?>">
					<label class="title"><?php __('lblName'); ?>:</label>
					<span class="inline_block">
						<input type="text" name="i18n[<?php echo $v['id']; ?>][name]" class="pj-form-field w300<?php echo (int) $v['is_default'] === 0 ? NULL : ' required'; ?>" lang="<?php echo $v['id']; ?>" />
						<?php if ((int) $tpl['option_arr']['o_multi_lang'] === 1 && count($tpl['lp_arr']) > 1) : ?>
						<span class="pj-multilang-input"><img src="<?php echo PJ_INSTALL_URL . PJ_FRAMEWORK_LIBS_PATH . 'pj/img/flags/' . $v['file']; ?>" alt="" /></span>
						<?php endif;?>
					</span>
				</p>
				<?php
			}
			?>
			
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
							?><option value="<?php echo $v['id']; ?>"><?php echo stripslashes($v['name']); ?></option><?php
						}
						?>
					</select>
				
				</span>
			</p>
			<?php } ?>
			
			<p>
				<label class="title"><?php __('lblSeatsMap'); ?></label>
				<span class="inline_block">
					<input type="file" name="seats_map" id="seats_map" class="pj-form-field" />
				</span>
			</p>
			<p class="seatmap">
				<label class="title">Select Map</label>
				<ul>
				<?php 
				$DefaultImg=$GLOBALS['DEFAULTSEATMAP'];
				$i=1;
				foreach ($DefaultImg as $Img) {
				?>
			
			  <li><input type="radio" name="defaultmapimg" value="<?php echo $Img ?>" id="cb<?php echo $i ?>" />
    <label for="cb<?php echo $i ?>"><img src="app/web/upload/bus_types/<?php echo $Img ?>" style="width: 70px;height: 70px" /></label>
  </li>
				<?php 
				$i++;
			} ?>
			</p>
			
			<p>
				<label class="title"><?php __('lblSeatsCount'); ?></label>
				<span class="inline_block">
					<input type="text" name="seats_count" id="seats_count" class="pj-form-field w80" />
				</span>
			</p>
			<p class="bsDefineSeats" style="display:none">
				<label class="title">&nbsp;</label>
				<span class="inline_block">
					<label class="content"><?php __('lblDefineSeats');?></label>
				</span>
			</p>
			<p>
				<label class="title">&nbsp;</label>
				<input type="submit" value="<?php __('btnSave'); ?>" class="pj-button" />
				<input type="button" value="<?php __('btnCancel'); ?>" class="pj-button" onclick="window.location.href='<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjAdminBusTypes&action=pjActionIndex';" />
			</p>
		</div>
	</form>
	
	<script type="text/javascript">
	var locale_array = new Array(); 
	var myLabel = myLabel || {};
	myLabel.field_required = "<?php __('bs_field_required'); ?>";
	<?php
	foreach ($tpl['lp_arr'] as $v)
	{
		?>locale_array.push(<?php echo $v['id'];?>);<?php
	} 
	?>
	myLabel.locale_array = locale_array;
	myLabel.localeId = "<?php echo $controller->getLocaleId(); ?>";
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