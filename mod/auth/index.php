	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	<br>

		<!-- Main content -->
		<section class="content">
			<div class="container">
			<!-- Default box -->

			<div class="row">
				<div class="col-sm-8">
					<img src="assets/images/banner.png" style="width: 100%">
					<br>
					<br>
					<p>
					<h3 align="center">
						Grab your certificate of participation to the <br>
						SDO-initiated events or trainings here. 
					</h3>	
					</p>
				</div>
								
				<div class="col-sm-4">	
					<div class="login-box">
						<!-- /.login-logo -->
						<div class="card">
							<div class="card-body login-card-body">
								<p align="center"><img src="assets/images/logo.png" style="width: 100px"></p>
								<p class="login-box-msg">Input your participant identifier here to get started...</p>
								<form role="form" id="form" method="post" onSubmit="return false;">
									<div class="input-group mb-3">
										<input type="text" class="form-control" name="email" id="email" placeholder="Email / PRC # / Employee #" autofocus required>
										<div class="input-group-append">
											<div class="input-group-text">
												<span class="fas fa-key"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-6">
										</div>
										<!-- /.col -->
										<div class="col-6">
											<button type="submit" id="submit" class="btn btn-primary btn-block" onClick="authenticateUser();">Sign In</button>
										</div>
									</div>
								</form>
								<br>
								<p class="mb-1">
									<strong>Which email to sign-in?</strong> 
									<br>Use the email / PRC # / employee # you used to register to the event.
								</p>
							</div>
						<!-- /.login-card-body -->
						</div>
					</div>
				</div>
			</div>
			</div><br>
			<!-- /.card -->
		</section>
    <!-- /.content -->
	

<script type="text/javascript">	
function authenticateUser(){
	var result = sanitizeForm();
	
	if(result[0] == true){
		var action = 'authenticateUser';
		var data = [action, result[1]];
		
		document.getElementById('submit').innerHTML = 'Verifying...';
		$('#submit').attr('disabled', 'disabled');
		
		$.ajax({
			type: 'POST',
			url: 'mod/auth/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					toastr.success('Redirecting...');
					setTimeout(function(){document.getElementById('submit').innerHTML = 'Signing in...';}, 500);	
					setTimeout(function(){window.location = '?p=my';}, 1000);
				} else {
					toastr.error('Email not found.	');	
					setTimeout(function(){$('#submit').removeAttr('disabled');}, 500);
					setTimeout(function(){document.getElementById('submit').innerHTML = 'Sign In';}, 500);	
				}
			}
		});
	}
}

function sanitizeForm(){
	var status = true;
	var email = $('#email').val();
	var result;
	
	email = email.trim();
	
	if(email == ''){
		status = false;
		toastr.error('Email is a required field.');
	} 
	
	result =  [status, email];
	
	return result;
}
</script>