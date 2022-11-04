<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AuditLog $auditLog
 */
?>
<?php
$created = date_create($auditLog->created);
$retention_date = date_create($auditLog->retention_date);
$now = new DateTime("now");
?>
<?php
$original_array = str_replace('"', ' ', $auditLog->original); //remove quote symbol
$original_array_trim = trim($original_array, '{}'); //remove curly bracket
$original_array_trim_break = str_replace(',', '<br />', $original_array_trim); //break line
//echo $original_array_trim_break;
?>
<?php
$change_array = str_replace('"', ' ', $auditLog->changed); //remove quote symbol
$change_array_trim = trim($change_array, '{}'); //remove curly bracket
$change_array_trim_break = str_replace(',', '<br />', $change_array_trim); //break line
//echo $change_array_trim_break;
?>
<?php
function get_decorated_diff($old, $new){
    $from_start = strspn($old ^ $new, "\0");        
    $from_end = strspn(strrev($old) ^ strrev($new), "\0");

    $old_end = strlen($old) - $from_end;
    $new_end = strlen($new) - $from_end;

    $start = substr($new, 0, $from_start);
    $end = substr($new, $new_end);
    $new_diff = substr($new, $from_start, $new_end - $from_start);  
    $old_diff = substr($old, $from_start, $old_end - $from_start);

    $new = "$start<ins style='background-color:#28a745'>$new_diff</ins>$end";
    $old = "$start<del style='background-color:#dc3545'>$old_diff</del>$end";
    return array("old"=>$old, "new"=>$new);
}

$string_old = $original_array_trim_break;
$string_new = $change_array_trim_break;
$diff = get_decorated_diff($string_old, $string_new);

//echo '<strong>Original:</strong> <br>' . $diff['old'];
//echo '<br>';
//echo '<strong>Changed:</strong> <br>' . $diff['new'];
?>
<?php $info = json_decode($auditLog->meta); ?>
<!--Header-->
<div class="row mb-3">
	<div class="col-10">
		<h1 class="m-0 me-2 page_title"><?php echo $title; ?></h1>
		<small class="text-muted"><?php echo $system_name; ?></small>
	</div>
	<div class="col-2">
		<div class="text-end">
<?php echo $this->Html->link(
    '<i class="fas fa-external-link-alt"></i> Original',
    $info->url,
    ['class' => 'btn btn-outline-primary btn-sm', 'escape' => false, 'target' => '_blank']
); ?>	
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-4">
		<div class="special_card mb-3">
		  <div class="profile-card js-profile-card shadow">
			<div class="profile-card__img shadow" style="background-color: #dc3545;color: #ffffff;">
			  <i class="fa-solid fa-timeline fa-xl" style="margin-left: 9px;margin-top: 24px;"></i>
			</div>
				<div class="card-body small-text pt-0">
		  <div class="table-responsive">
<table class="table table-hover text-nowrap table-sm">
                <tr>
                    <th><?= __('Transaction ID') ?></th>
                    <td><?= h($auditLog->transaction) ?></td>
                </tr>
                <tr>
                    <th><?= __('Activity') ?></th>
                    <td>
<?php 
if ($auditLog->type == 'create'){
echo '<span class="badge bg-success">Create</span>';
} elseif ($auditLog->type == 'update'){
echo '<span class="badge bg-warning">Update</span>';
} elseif ($auditLog->type == 'delete'){
echo '<span class="badge bg-danger">Delete</span>'; 
} elseif ($auditLog->type == 'archived'){
echo '<span class="badge bg-danger">Archived</span>'; 
}else
echo ($auditLog->type);
?>					
					</td>
                </tr>
                <tr>
                    <th><?= __('Source') ?></th>
                    <td><?= h($auditLog->source) ?></td>
                </tr>
                <tr>
                    <th><?= __('Parent Source') ?></th>
                    <td><?= h($auditLog->parent_source) ?></td>
                </tr>
                <tr>
                    <th><?= __('Audit Log ID') ?></th>
                    <td><?= $this->Number->format($auditLog->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Primary Key') ?></th>
                    <td><?= $this->Number->format($auditLog->primary_key) ?></td>
                </tr>
				<tr>
					<th>Logged Date</th>
					<td><?php echo date('F d, Y', strtotime($auditLog->created)); ?></td>
				</tr>
				<tr>
					<th>Days from changes</th>
					<td>
						<?php
						$interval = date_diff($created, $now);
						echo $interval->format('%y Year %m Month %d Day');
						?>
					</td>
				</tr>
				<tr>
					<th>IP Address</th>
					<td>
						<?php echo $info->ip; ?>
					</td>
				</tr>
				<tr>
					<th>URL</th>
					<td>
						<?php echo $info->url; ?>
					</td>
				</tr>
				<tr>
					<th>Controller</th>
					<td>
						<?php echo $info->c_name; ?>
					</td>
				</tr>
				<tr>
					<th>Action</th>
					<td>
						<?php echo $info->a_name; ?>
					</td>
				</tr>
				<tr>
					<th>User</th>
					<td>
						<?php echo $info->slug; ?>
					</td>
				</tr>
            </table>

		  </div>
				</div>
		  </div>
		</div>
	</div>
	<div class="col-md-8">


<style>
.ribbon-wrapper {
    height: 70px;
    overflow: hidden;
    position: absolute;
    right: -2px;
    top: -2px;
    width: 70px;
    z-index: 10;
}
.ribbon-wrapper .ribbon {
    box-shadow: 0 0 3px rgb(0 0 0 / 30%);
    font-size: 0.6rem;
    line-height: 100%;
    padding: 0.375rem 0;
    position: relative;
    right: -2px;
    text-align: center;
    text-shadow: 0 -1px 0 rgb(0 0 0 / 40%);
    text-transform: uppercase;
    top: 10px;
    -webkit-transform: rotate(45deg);
    transform: rotate(45deg);
    width: 90px;
	color: #ffffff;
}
.page_title_bold {
    font-size: 19px;
    font-weight: 600;
    text-transform: uppercase;
    font-weight: bold;
	color: #ffffff;
}
.text_white{
	color: #ffffff;
}

</style>
<div class="card shadow mb-3 bg-gray text_white">
	<div class="ribbon-wrapper">
	<div class="ribbon bg-primary">
	  Original
	</div>
	</div>
	<div class="card-body">
	<div class="page_title_bold">Original</div>
<?php echo $diff['old']; ?>
	</div>
</div>

<div class="card shadow mb-3 bg-gray text_white">
	<div class="ribbon-wrapper">
	<div class="ribbon bg-success">
	  Changed
	</div>
	</div>
	<div class="card-body">
	<div class="page_title_bold">Changed</div>
<?php echo $diff['new']; ?>
	</div>
</div>


<div class="special_card mb-3">
  <div class="profile-card js-profile-card shadow">
	<div class="profile-card__img shadow" style="background-color: #dc3545;color: #ffffff;">
	  <i class="fa-solid fa-code fa-xl" style="margin-left: 9px;margin-top: 21px;"></i> <b class="mx-2">Raw Data</b>
	</div>
<style>
.special_card_title{
	margin-left: 100px;
	margin-top: -20px;
}
</style>
		<div class="card-body small-text pt-0">
            <div class="text">
                <strong><?= __('Original') ?></strong>
                <blockquote class="text-break">
                    <?= $this->Text->autoParagraph(h($auditLog->original)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Changed') ?></strong>
                <blockquote class="text-break">
                    <?= $this->Text->autoParagraph(h($auditLog->changed)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Meta') ?></strong>
                <blockquote class="text-break">
                    <?= $this->Text->autoParagraph(h($auditLog->meta)); ?>
                </blockquote>
            </div>
		</div>
  </div>
</div>

</div>
</div>
