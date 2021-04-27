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
						Participants who have participated the sessions can search the certificates here.
					</h4>	
					</p>
					<div class="card">
					<div class="card-body p-0" id="verify-result">
						<table class="table">
						  <thead>
							<tr>
							  <th style="width: 10px">#</th>
							  <th>Participant Name</th>
							  <th>Session Title</th>
							  <th style="width: 40px"></th>
							</tr>
						  </thead>
						  <tbody id="result-list">
						  </tbody>
						</table>
					  </div>
					  <!-- /.card-body -->
					</div>
				</div>
								
				<div class="col-sm-4">	
					<div class="login-box">
						<!-- /.login-logo -->
						<div class="card">
							<div class="card-body login-card-body">
								<p align="center"><img src="assets/images/logo.png" style="width: 100px"></p>
								<p class="login-box-msg">Input your search phrase here</p>
								<form role="form" id="form" method="post" onSubmit="return false;">
									<div class="input-group mb-3">
										<input type="text" class="form-control" name="cer_fullname_search" id="cer_fullname_search" placeholder="APOLINARIO M. MABINI" autofocus required>
										<div class="input-group-append">
											<div class="input-group-text">
												<span class="fas fa-search"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-7">
										</div>
										<!-- /.col -->
										<div class="col-5">
											<button type="submit" id="submit" class="btn btn-primary btn-block" onClick="searchCertificate();">Search</button>
										</div>
									</div>
								</form>
								<p class="mb-1">
									<strong>What will I search?</strong> 
									<br>Lookup for your for your name which you inputted when you took the session assessment. You may also just search for your lastname or firstname.
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

function searchCertificate(){
	var result = sanitizeForm();
	
	if(result[0] == true){
		var action = 'searchCertificate';
		var data = [action, result[1]];
				
		$.ajax({
			type: 'POST',
			url: 'mod/search/action.php',
			data: {data:data},	
			success: function(result){
				setTimeout(function(){
					$('#verify-result').show();					
					$('#result-list').html(result);					
				}, 1000);
				
				$('#cer_fullname_search').val('');
			}
		});
	}
}

function sanitizeForm(){
	var status = true;
	var cer_fullname_search = $('#cer_fullname_search').val();
	var result;
	
	cer_fullname_search = cer_fullname_search.trim();
	
	if(cer_fullname_search == ''){
		status = false;
		toastr.error('Code is a required field.');
	} else if(cer_fullname_search.length < 3){
		status = false;
		toastr.error('Input at least three characters.');
	} 
	
	result =  [status, cer_fullname_search];
	
	return result;
}
</script>