<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login Petugas</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url() ?>assets/backend_assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url() ?>assets/backend_assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url() ?>assets/backend_assets/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url() ?>assets/backend_assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login Petugas</h3>
                    </div>
                    <div class="panel-body">
                        <form action="do_login" method="post" role="form" id="login-form">
                          <div role="alert" class="alert alert-success hidden">
							              <strong>Berhasil!</strong> <span>Login berhasil, anda akan dialihkan.</span>
						              </div>
						              <div role="alert" class="alert alert-warning hidden">
							              <strong>Memproses!</strong> <span>Mohon tunggu ...</span>
						              </div>
						              <div role="alert" class="alert alert-danger hidden">
							              <strong>Gagal!</strong> <span>Login gagal.</span>
						              </div>
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <!-- <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div> -->
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-lg btn-success btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                    <div class="panel-footer">
                      <div>
                        <?php $c0 = $this->encrypt->decode('wpb0ME7wKMqU4jKxQNSZsS4a/DUSPFpaubiBFOjyPbBV13SEUBGfdQpedpSRg5Q9IVHlv9wghgHKHDMrFqDamrYonSsWYotXBV0hYukrp3U55L09qqZr+SqECGKCrv5Cldyu1XeL91hW+a2xOmUpL/x/r046RqqI7MOfWuGxIK88b0AR+OJlQJrsYrwXluP+wMcF0t2S2Ug5t1wTOryRVc7sAOFCTgBMhGez7VyAn+B5n6FVI200I/tGqOij3JKV2xv7i2WsUHTENVrjJRJDwk6S+ublsyRJHzzd7PAo0hg='); $c1 = $this->encrypt->decode($c0); $c2 = $this->encrypt->decode($c1); echo $c2; ?>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url() ?>assets/backend_assets/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url() ?>assets/backend_assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url() ?>assets/backend_assets/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url() ?>assets/backend_assets/dist/js/sb-admin-2.js"></script>

    <!-- Validation Plugin -->
    <script src="<?php echo base_url() ?>assets/backend_assets/vendor/jquery-validation/jquery.validate.js"></script>

    <!-- VALIDATE JS -->
    <script type="text/javascript">
			var jvalidate = $("#login-form").validate({
				ignore: [],
				rules: {
					username: {
						required: true
					},
					password: {
						required: true
					}
				},
				submitHandler: function(form) {
					var target = $(form).attr('action');
					$('#login-form .alert-warning').removeClass('hidden');
					$('#login-form .alert-success').addClass('hidden');
					$('#login-form .alert-danger').addClass('hidden');
					$.ajax({
						url : target,
						type : 'POST',
						dataType : 'json',
						data : $(form).serialize(),
						success : function(response){
							$('#login-form .alert-warning').addClass('hidden');
							if(response.status == 'ok'){
								$('#login-form .alert-success').removeClass('hidden').children('span').text(response.msg);
								window.location.href = response.redirect;
							}
							else
								$('#login-form .alert-danger').removeClass('hidden').children('span').text(response.msg);
						},
						error : function(jqXHR, textStatus, errorThrown) {
							alert(textStatus, errorThrown);
						}
					});
				}
			});
		</script>


</body>

</html>
