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
					<h4 align="center">
						Participants who have barcoded certificates can verify it from here.
					</h4>	
					</p>
					<div class="info-box bg-info" id="verify-result">
					  <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

					  <div class="info-box-content">
						<span class="info-box-number" id="cer_code">#</span>
						<span class="info-box-text" id="cer_fullname">#</span>
						<span class="info-box-text" id="ses_title">#</span>
						<span class="info-box-text" id="ses_session">#</span>
						<span class="info-box-text" id="ses_dates">#</span>

					  </div>
					  <!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
								
				<div class="col-sm-4">	
					<div class="login-box">
						<!-- /.login-logo -->
						<div class="card">
							<div class="card-body login-card-body">
								<p align="center"><img src="assets/images/logo.png" style="width: 100px"></p>
								<p class="login-box-msg">Input the code to verify certificate</p>
								<form role="form" id="form" method="post" onSubmit="return false;">
									<div class="input-group mb-3">
										<input type="text" class="form-control" name="cer_code_search" id="cer_code_search" placeholder="Code" autofocus required>
										<div class="input-group-append">
											<div class="input-group-text">
												<span class="fas fa-barcode"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-7">
										</div>
										<!-- /.col -->
										<div class="col-5">
											<button type="submit" id="submit" class="btn btn-primary btn-block" onClick="verifyCertificate();">Verify</button>
										</div>
									</div>
								</form>
								<p class="mb-1">
									<strong>Where can I see the code?</strong> 
									<br>It's serial number below the Certificate QR code.
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
setTimeout(function(){preLoad();}, 1);

function preLoad(){
	$('#verify-result').hide();
}

function verifyCertificate(){
	var result = sanitizeForm();
	
	if(result[0] == true){
		var action = 'verifyCertificate';
		var data = [action, result[1]];
		
		document.getElementById('submit').innerHTML = 'Verifying...';
		$('#submit').attr('disabled', 'disabled');
		
		$.ajax({
			type: 'POST',
			url: 'mod/verify/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					setTimeout(function(){document.getElementById('submit').innerHTML = 'Displaying...';}, 500);
					setTimeout(function(){
						$('#verify-result').show();					
						document.getElementById('cer_code').innerHTML = result[2].cer_code;
						document.getElementById('cer_fullname').innerHTML = result[2].cer_fullname;
						document.getElementById('ses_title').innerHTML = result[2].ses_title;
						document.getElementById('ses_session').innerHTML = result[2].ses_session;
						document.getElementById('ses_dates').innerHTML = result[2].ses_dates;
					}, 1000);
					setTimeout(function(){$('#submit').removeAttr('disabled');}, 1000);
					setTimeout(function(){document.getElementById('submit').innerHTML = 'Verify';}, 1000);

				} else {
					toastr.error('Code not found.');	
					setTimeout(function(){$('#submit').removeAttr('disabled');}, 500);
					setTimeout(function(){document.getElementById('submit').innerHTML = 'Verify';}, 500);	
					$('#verify-result').hide();
				}
				
				$('#cer_code_search').val('');
			}
		});
	}
}

function sanitizeForm(){
	var status = true;
	var cer_code_search = $('#cer_code_search').val();
	var result;
	
	cer_code_search = cer_code_search.trim();
	
	if(cer_code_search == ''){
		status = false;
		toastr.error('Code is a required field.');
	} 
	
	result =  [status, cer_code_search];
	
	return result;
}
</script>