<?php
?>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<form action="" id="manage_file">
				<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
				<div class="row">
					<div class="col-md-6 border-right">
						<div class="form-group">
							<label for="" class="control-label">File Name</label>
							<input type="text" name="file_name" class="form-control form-control-sm" required value="<?php echo isset($file_name) ? $file_name : '' ?>">
						</div>
						
						<?php if($_SESSION['login_type'] == 1): ?>
					
						<?php else: ?>
							<input type="hidden" name="type" value="3">
						<?php endif; ?>
						<div class="form-group">
							<label for="" class="control-label">File</label>
							<div class="custom-file">
		                      <input type="file" class="custom-file-input" id="customFile" name="img" onchange="displayImg(this,$(this))">
		                      <label class="custom-file-label" for="customFile">Choose file</label>
		                    </div>
						</div>
						<div class="form-group d-flex justify-content-center align-items-center">
							<img src="<?php echo isset($f_data) ? 'assets/uploads/'.$f_data :'' ?>" alt="f_data" id="cimg" class="img-fluid img-thumbnail ">
						</div>
					</div>
					<div class="col-md-6">
						
					<div class="form-group">
							<label for="" class="control-label">File Description</label>
							<textarea name="file_code" class="form-control form-control-sm" required value="<?php echo isset($file_code) ? $file_code : '' ?>"></textarea>
						</div>
						<div class="form-group">
              <label for="" class="control-label">Issue Date</label>
              <input type="date" class="form-control form-control-sm" autocomplete="off" name="issue_Date" value="<?php echo isset($issue_Date) ? date("Y-m-d",strtotime($issue_Date)) : '' ?>">
            </div>
					</div>
				</div>
				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex">
					<button class="btn btn-primary mr-2">Save</button>
					<button class="btn btn-secondary" type="button" onclick="location.href = 'index.php?page=file_list'">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>
<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
</style>
<script>
	// $('[name="password"],[name="cpass"]').keyup(function(){
	// 	var pass = $('[name="password"]').val()
	// 	var cpass = $('[name="cpass"]').val()
	// 	if(cpass == '' ||pass == ''){
	// 		$('#pass_match').attr('data-status','')
	// 	}else{
	// 		if(cpass == pass){
	// 			$('#pass_match').attr('data-status','1').html('<i class="text-success">Password Matched.</i>')
	// 		}else{
	// 			$('#pass_match').attr('data-status','2').html('<i class="text-danger">Password does not match.</i>')
	// 		}
	// 	}
	// })
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$('#manage_file').submit(function(e){
		// e.preventDefault()
		// $('input').removeClass("border-danger")
		// start_load()
		// $('#msg').html('')
		// if($('[name="password"]').val() != '' && $('[name="cpass"]').val() != ''){
		// 	if($('#pass_match').attr('data-status') != 1){
		// 		if($("[name='password']").val() !=''){
		// 			$('[name="password"],[name="cpass"]').addClass("border-danger")
		// 			end_load()
		// 			return false;
		// 		}
		// 	}
		// }
		$.ajax({
			url:'ajax.php?action=save_file',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved.',"success");
					setTimeout(function(){
						location.replace('index.php?page=file_list')
					},750)
				}else if(resp == 2){
					$('#msg').html("<div class='alert alert-danger'>Email already exist.</div>");
					$('[name="email"]').addClass("border-danger")
					end_load()
				}
			}
		})
	})
</script>