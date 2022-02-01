<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index.php?page=bioPharma_new_file"><i class="fa fa-plus"></i> Add New File</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>File Name</th>
						<th>File Hint</th>
						<th>Issue Date</th>
                        <th>File</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$type = array('',"Admin","Project Manager","Employee");
					$qry = $conn->query("SELECT *,concat(file_name,' ',file_code) as name FROM pharma order by concat(file_name,' ',file_code) asc");
					// $qry = $conn->query("SELECT * FROM filing ");
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><?php echo ucwords($row['file_name']) ?></b></td>
						<td><b><?php echo $row['file_code'] ?></b></td>
						<td><b><?php echo $row['issue_Date']?></b></td>
                        <td><b><?php echo $row['f_data'] ?></b></td>
						<td class="text-center">
							<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Action
		                    </button>
		                    <div class="dropdown-menu" style="">
		                      <a class="dropdown-item view_file" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">View</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item" href="./index.php?page=bioPharma_edit&id=<?php echo $row['id'] ?>">Edit</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item delete_pharma_file" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
		                    </div>
						</td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('#list').dataTable()
	$('.view_file').click(function(){
		uni_modal("<i class='fa fa-id-card'></i> User Details","bioPharma_view.php?id="+$(this).attr('data-id'))
	})
	$('.delete_pharma_file').click(function(){
	_conf("Are you sure to delete this file?","delete_pharma_file",[$(this).attr('data-id')])
	})
	})
	function delete_pharma_file($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_pharma_file',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>