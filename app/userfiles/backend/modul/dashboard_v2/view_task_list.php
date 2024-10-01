<div class="card">
	<div class="card-body">
	<h5>Finish</h5>
		<div class="active-member">
			<div class="table-responsive">
				<table class="table table-xs mb-0">
					<thead>
						<tr>
							<th>Task</th>
							<th>Project</th>
							<th>Assign To</th>
							<th>Status</th>
							<th style="text-align:center;">Updated</th>
							<th>Deadline</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($list_task_by_date_done as $date=>$tasks):?>	
					
						<tr>
							<td colspan="6"><b><?=($date==date("Y-m-d")?'Today Tasks':tgl_indo_short($date)); ?></b></td>
						</tr>
						<?php foreach($tasks as $data):?>	

						<tr>
							<td>&nbsp;&nbsp;&nbsp;<?=$data['title']; ?></td>
							<td><?=$data['project_title']; ?></td>
							<td><?=$data['username']; ?></td>
							<td>
								<div class="btn-group">
									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<span class="yona_checklist"><?=ucfirst($data['status']); ?><span>
									</button>
									<div class="dropdown-menu dropdown-menu-right">
										<button class="dropdown-item" onclick="updateStatus(this)" data-id="<?=$data['id']; ?>" data-value="New" type="button">New</button>
										<button class="dropdown-item" onclick="updateStatus(this)" data-id="<?=$data['id']; ?>" data-value="Start" type="button">Start</button>
										<button class="dropdown-item" onclick="updateStatus(this)" data-id="<?=$data['id']; ?>" data-value="Resolve" type="button">Resolve</button>
										<button class="dropdown-item" onclick="updateStatus(this)" data-id="<?=$data['id']; ?>" data-value="Close" type="button">Close</button>
									</div>
								</div>
							</td>
							<td style="text-align:center;" id="yona_update_at_<?=$data['id']; ?>"><?=getTimeDifference($data['modified_at']=='0000-00-00 00:00:00'?$data['created_at']:$data['modified_at']); ?> ago</td>
							<td><?=$data['end_date']=='0000-00-00'?'':tgl_indo_short($data['end_date']); ?></td>
							
						</tr>
						<?php endforeach;?>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>         


<div class="card">
	<div class="card-body">
	<h5>Task</h5>
		<div class="active-member">
			<div class="table-responsive">
				<table class="table table-xs mb-0">
					<thead>
						<tr>
							<th>Task</th>
							<th>Project</th>
							<th>Assign To</th>
							<th>Status</th>
							<th style="text-align:center;">Updated</th>
							<th>Deadline</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($list_task_by_date as $date=>$tasks):?>	
					
						<tr>
							<td colspan="6"><b><?=($date==date("Y-m-d")?'Today Tasks':tgl_indo_short($date)); ?></b></td>
						</tr>
						<?php foreach($tasks as $data):?>	

						<tr>
							<td>&nbsp;&nbsp;&nbsp;<?=$data['title']; ?></td>
							<td><?=$data['project_title']; ?></td>
							<td><?=$data['username']; ?></td>
							<td>
								<div class="btn-group">
									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<span class="yona_checklist"><?=ucfirst($data['status']); ?><span>
									</button>
									<div class="dropdown-menu dropdown-menu-right">
										<button class="dropdown-item" onclick="updateStatus(this)" data-id="<?=$data['id']; ?>" data-value="New" type="button">New</button>
										<button class="dropdown-item" onclick="updateStatus(this)" data-id="<?=$data['id']; ?>" data-value="Start" type="button">Start</button>
										<button class="dropdown-item" onclick="updateStatus(this)" data-id="<?=$data['id']; ?>" data-value="Resolve" type="button">Resolve</button>
										<button class="dropdown-item" onclick="updateStatus(this)" data-id="<?=$data['id']; ?>" data-value="Close" type="button">Close</button>
									</div>
								</div>
							</td>
							<td style="text-align:center;" id="yona_update_at_<?=$data['id']; ?>"><?=getTimeDifference($data['modified_at']=='0000-00-00 00:00:00'?$data['created_at']:$data['modified_at']); ?> ago</td>
							<td><?=$data['end_date']=='0000-00-00'?'':tgl_indo_short($data['end_date']); ?></td>
							
						</tr>
						<?php endforeach;?>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>              
