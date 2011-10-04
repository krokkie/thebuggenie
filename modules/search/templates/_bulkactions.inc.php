<form method="post" onsubmit="TBG.Search.bulkUpdate('<?php echo make_url('issues_bulk_update'); ?>', '<?php echo $mode; ?>');return false;" id="bulk_action_form_<?php echo $mode; ?>">
	<?php if (TBGContext::isProjectContext()): ?>
		<input type="hidden" name="project_key" value="<?php echo TBGContext::getCurrentProject()->getKey(); ?>">
	<?php endif; ?>
	<div class="search_bulk_container <?php echo $mode; ?> unavailable">
		<label for="bulk_action_selector_<?php echo $mode; ?>"><?php echo __('With selected issue(s): %action%', array('%action%' => '')); ?></label>
		<select name="bulk_action" id="bulk_action_selector_<?php echo $mode; ?>" onchange="TBG.Search.bulkContainerChanger('<?php echo $mode; ?>');">
			<option value=""><?php echo __('Do nothing'); ?></option>
			<?php if (TBGContext::isProjectContext()): ?>
				<option value="assign_milestone"><?php echo __('Assign to milestone'); ?></option>
			<?php endif; ?>
			<option value="set_status"><?php echo __('Set status'); ?></option>
			<option value="perform_workflow_step"><?php echo __('Choose workflow step to perform'); ?></option>
		</select>
		<?php if (TBGContext::isProjectContext()): ?>
			<span class="bulk_action_subcontainer" id="bulk_action_subcontainer_assign_milestone_<?php echo $mode; ?>" style="display: none;">
				<select name="milestone" id="bulk_action_assign_milestone_<?php echo $mode; ?>" class="focusable" onchange="TBG.Search.bulkChanger('<?php echo $mode; ?>'); if ($(this).getValue() == 'new') { ['bulk_action_assign_milestone_top_name', 'bulk_action_assign_milestone_bottom_name'].each(function(element) { $(element).show(); }); } else { ['bulk_action_assign_milestone_top_name', 'bulk_action_assign_milestone_bottom_name'].each(function(element) { $(element).hide(); }); }">
					<option value="0"><?php echo __('No milestone'); ?></option>
					<option value="new"><?php echo __('Create new milestone from selected issues'); ?></option>
					<?php foreach (TBGContext::getCurrentProject()->getAllMilestones() as $milestone_id => $milestone): ?>
						<option id="bulk_action_assign_milestone_<?php echo $mode; ?>_<?php echo $milestone_id; ?>" value="<?php echo $milestone_id; ?>"><?php echo $milestone->getName(); ?></option>
					<?php endforeach; ?>
				</select>
				<input type="text" name="milestone_name" style="display: none;" id="bulk_action_assign_milestone_<?php echo $mode; ?>_name">
			</span>
		<?php endif; ?>
		<span class="bulk_action_subcontainer" id="bulk_action_subcontainer_set_status_<?php echo $mode; ?>" style="display: none;">
			<select name="status" id="bulk_action_set_status_<?php echo $mode; ?>" class="focusable" onchange="TBG.Search.bulkChanger('<?php echo $mode; ?>');">
				<?php foreach (TBGStatus::getAll() as $status_id => $status): ?>
					<option value="<?php echo $status_id; ?>"><?php echo $status->getName(); ?></option>
				<?php endforeach; ?>
			</select>
		</span>
		<span class="bulk_action_subcontainer" id="bulk_action_subcontainer_perform_workflow_step_<?php echo $mode; ?>" style="display: none;">
		</span>
		<input type="submit" class="button button-silver" value="<?php echo __('Apply'); ?>">
	</div>
</form>