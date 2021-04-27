	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	<br>

		<!-- Main content -->
		<section class="content">
			<div class="container">
			<!-- Default box -->

			<div class="row">
				<div class="col-md-8">
					<div class="card">
					  <div class="card-header">
						<h3 class="card-title">Your Certificate(s)</h3>
					  </div>
					  <!-- /.card-header -->
					  <div class="card-body table-responsive p-0" style="height: 300px;"><small>
						<table class="table table-head-fixed">
						  <thead>
							<tr>
							  <th>Code</th>
							  <th>Name on Certificate</th>
							  <th>Topic</th>
							  <th></th>
							</tr>
						  </thead>
						  <tbody id="my-certificate">
							<tr>
							  <td>183</td>
							  <td>John Doe</td>
							  <td>11-7-2014</td>
							  <td><a href="" onclick="window.open('mod/cert/index.php', 'newwindow', 'width=1100, height=600'); return false;"><i class="fas fa-download"></i></a></td>
							</tr>
						  </tbody>
						</table></small>
					  </div>
					  <!-- /.card-body -->
					  <div class="card-footer clearfix">
						<small>Click the download <i class="fas fa-download" title="download"></i>  icon to download your certificate.</small>
					  </div>
					</div>
					<!-- /.card -->
				</div>
								
				<div class="col-md-4">	
					<div class="login-box">
						<!-- /.login-logo -->
							<div class="card card-widget widget-user-2">
							  <!-- Add the bg color to the header using any of the bg-* classes -->
							  <div class="widget-user-header bg-success">
								<div class="widget-user-image">
								  <img class="img-circle elevation-2" src="assets/avatars/avatar-0.jpg" alt="User Avatar">
								</div>
								<!-- /.widget-user-image -->
								<h4 class="widget-user-username" id="cer_fullname">#</h4>
								<h6 class="widget-user-desc"><small id="cer_email">#</small></h6>
							  </div>
							  <div class="card-footer p-0">
								<ul class="nav flex-column">
								  <li class="nav-item">
									<a href="#" class="nav-link">
									  Age <span class="float-right" id="cer_age">#</span>
									</a>
								  </li>
								  <li class="nav-item">
									<a href="#" class="nav-link">
									  Sex <span class="float-right" id="cer_sex">#</span>
									</a>
								  </li>
								  <li class="nav-item">
									<a href="#" class="nav-link">
									  School Level <span class="float-right" id="cer_level">#</span>
									</a>
								  </li>
								  <li class="nav-item">
									<a href="#" class="nav-link">
									  Role <span class="float-right" id="cer_role">#</span>
									</a>
								  </li>
								</ul>
							  </div>
							<!-- /.widget-user -->

						</div>
					</div>
					<a href="?p=auth&logout" type="button" class="btn btn-block btn-danger btn-lg">Sign out</a>
				</div>
			</div>
			</div><br>
			<!-- /.card -->
		</section>
    <!-- /.content -->
	<!-- /.content-wrapper -->
	
	
<script type="text/javascript">	
var certgen_email = "<?php echo $_SESSION['certgen_email'];?>";

setTimeout(function(){preLoad();}, 1);

function preLoad(){
	loadProfile(certgen_email);
	loadCertificate(certgen_email);
}

function loadProfile(certgen_email){
	var result = sanitizeForm();
	
	if(result[0] == true){
		var action = 'loadProfile';
		var data = [action, result[1]];
		

		$.ajax({
			type: 'POST',
			url: 'mod/my/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					toastr.success('Welcome to CertGen!');
					setTimeout(function(){
						document.getElementById('cer_fullname').innerHTML = result[2].cer_fullname;
						document.getElementById('cer_email').innerHTML = result[2].cer_email;
						document.getElementById('cer_age').innerHTML = result[2].cer_age;
						document.getElementById('cer_sex').innerHTML = result[2].cer_sex;
						document.getElementById('cer_level').innerHTML = result[2].cer_level;
						document.getElementById('cer_role').innerHTML = result[2].cer_role;
					}, 500);	
				} else {
					toastr.error('Email not found, logging out...');	
					setTimeout(function(){window.location = "?p=auth&logout";}, 500);	
				}
			}
		});
	}
}


function loadCertificate(certgen_email){
	var result = sanitizeForm();
	
	if(result[0] == true){
		var action = 'loadCertificate';
		var data = [action, result[1]];
		

		$.ajax({
			type: 'POST',
			url: 'mod/my/action.php',
			data: {data:data},	
			success: function(result){
				$('#my-certificate').html(result);
			}
		});
	}
}


function sanitizeForm(){
	var status = true;
	var result;
	
	certgen_email = certgen_email.trim();
	
	if(certgen_email == ''){
		status = false;
		toastr.error('Email is a required field.');
	} 
	
	result =  [status, certgen_email];
	
	return result;
}


</script>