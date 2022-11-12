<div class="horizontal_menu">
<div class="btn-group">
  <button type="button" class="btn btn-outline btn-sm btn-flat" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-bars text-primary"></i>
  </button>
  <div class="dropdown-menu dropdown-menu-right">
		<?= $this->Html->link(__('<i class="fas fa-cog"></i> System Setting'), ['action' => 'update',1], ['class' => 'dropdown-item', 'escape' => false]) ?>
	<div class="dropdown-divider"></div>
	<?= $this->Html->link(__('<i class="far fa-hdd"></i> Clear Cache'), ['action' => 'clearCache'], ['class' => 'dropdown-item', 'escape' => false]) ?>
			
	<?= $this->Html->link(__('<i class="fas fa-list"></i> Server Info'), ['action' => 'index'], ['class' => 'dropdown-item', 'escape' => false]) ?>
  </div>
</div>
</div>

<div class="card2">
	<div class="header">
		<div class="panel_card2_title">Re-CRUD Logs</div>
		<div class="panel_card2_subtitle"><?= $organization_name; ?></div>
	</div>
	<div class="body table-responsive">
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th><?php echo __('#');?></th>

					<th><?php echo __('Log File');?></th>

					<th><?php echo __('File Size');?></th>

					<th><?php echo __('Last Modified');?></th>

					<th><?php echo __('Action');?></th>
				</tr>
			</thead>

			<tbody>
				<?php
				$i = 0;
				
				foreach($logFiles as $logFile) {
					$i++;
					$pathinfo = pathinfo($logFile);
					$filesize = round((filesize($logFile) / 1024), 2);
					$filesizeText = $filesize.' KB';
					
					if($filesize > 1024) {
						$filesize = round(($filesize / 1024), 2);
						$filesizeText = $filesize.' MB';
					}
					
					$filemtime = filemtime($logFile);

					echo "<tr>";
						echo "<td>".$i."</td>";
						
						echo "<td>".$pathinfo['basename']."</td>";
						
						echo "<td>".$filesizeText."</td>";
						
						echo "<td>".date('d-M-Y h:i:s A', $filemtime)."</td>";
						
						echo "<td>";
							//echo $this->Html->link(__('View/Edit', true), ['action'=>'cakelog', $pathinfo['basename']]);
							echo $this->Html->link(__('<i class="far fa-folder-open"></i> View/Edit', true), ['action'=>'cakelog', $pathinfo['basename']], ['class' => 'btn btn-outline-primary btn-xs', 'escape' => false]);
							echo "&nbsp;";

							//echo $this->Form->postLink(__('Create Backup Copy', true), ['action'=>'cakelogbackup', $pathinfo['basename']], ['confirm'=>__('Are you sure, you want to create a copy of ').$pathinfo['basename'].'?']);
							echo $this->Form->postLink(__('<i class="fas fa-chevron-down"></i> Backup', true), ['action'=>'cakelogbackup', $pathinfo['basename']], ['confirm' => __('Are you sure you want to create a copy of '). $pathinfo['basename'].'?', 'class' => 'btn btn-outline-primary btn-xs', 'escape' => false]);
							echo "&nbsp;";

							echo $this->Form->postLink(__('<i class="far fa-square"></i> Empty File', true), ['action'=>'cakelogempty', $pathinfo['basename']], ['confirm'=>__('Are you sure, you want to make empty the log file ').$pathinfo['basename'].'? '.__('You should create a backup before making empty this file.'),'class' => 'btn btn-outline-primary btn-xs', 'escape' => false]);
							echo "&nbsp;";

							echo $this->Form->postLink(__('<i class="far fa-trash-alt"></i> Delete', true), ['action'=>'cakelogdelete', $pathinfo['basename']], ['confirm'=>__('Are you sure, you want to delete the log file ').$pathinfo['basename'].'?', 'class' => 'btn btn-outline-danger btn-xs', 'escape' => false]);
						echo "</td>";
					echo "</tr>";
				}?>
			</tbody>
		</table>

		<div style="padding:15px">
			<?php echo __('It is recommended to backup the log file on weekly or monthly basis. It can improve the site performance.');?>
			<br/><br/>
			
			<?php
			if(!empty($filename)) {
				$filepath = LOGS.$filename;
				$filesize = round((filesize($filepath) / 1024), 1);
				$pathinfo = pathinfo($filepath);?>

				<div class="clearfix">
					<div class="float-right">
						<?php echo $this->Html->link(__('Close', true), ['action'=>'cakelog'], ['class'=>'btn btn-primary btn-sm']);?>
					</div>
					<h4><?php echo $filename.__(' details');?></h4>
				
				</div>
				<br/>

				<?php echo $this->Form->create(null, ['onsubmit'=>'return confirm("Are you sure, Saving this file will overwrite existing file")']);?>

				<?php echo $this->Form->control('Settings.logfile', ['type'=>'textarea', 'label'=>false, 'class'=>'p-3', 'style'=>'width:99%;height:200px', 'value'=>file_get_contents($filepath)]);?>
				
				<div class="row form-group border-top pt-3">
					<div class="col">
						<?php echo $this->Form->Submit(__('Save'), ['class'=>'btn btn-primary']);?>
					</div>
				</div>
				
				<?php echo $this->Form->end();?>
			<?php
			}?>
		</div>


	</div>
</div>