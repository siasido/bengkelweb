
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Register</title>

  <!-- Custom fonts for this template-->
  <link href="<?=base_url()?>assets/template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?=base_url()?>assets/template/css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user" action="<?=site_url('users/selfregistration')?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <input type="text" name="fullname" value="<?php echo set_value('fullname');?>" class="form-control form-control-user" id="fullname" placeholder="Nama Lengkap">
                  <label style="color:red" for="fullname"><?php echo form_error('fullname'); ?></label>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" name="username" value="<?php echo set_value('username');?>" class="form-control form-control-user" id="username" placeholder="Username">
                    <label style="color:red" for="username"><?php echo form_error('username');?></label>
                  </div>
                  <div class="col-sm-6">
                    <input type="number" name="nohp" value="<?php echo set_value('nohp');?>" class="form-control form-control-user" id="nohp" placeholder="No. Handphone">
                    <label style="color:red" for="nohp"><?php echo form_error('nohp'); ?></label>
                  </div>
                </div>
                
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" name="password" value="<?php echo set_value('password');?>" class="form-control form-control-user" id="password" placeholder="Password">
                    <label style="color:red" for="password"><?php echo form_error('password');?></label>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" name="passconf" value="<?php echo set_value('passconf');?>" class="form-control form-control-user" id="passconf" placeholder="Repeat Password">
                    <label style="color:red" for="passconf"><?php echo form_error('passconf');?></label>
                  </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="form-group">
                        <!-- <label for="foto">Foto</label> -->
                        <div class="input-group">
                            <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input" id="image">
                            <label class="custom-file-label" for="image">Pilih Foto</label>
                            </div>
                        </div>
                    </div>
                </div>

                <button name="submit" class="btn btn-primary btn-user btn-block">
                  Register Account
                </button>
                <hr>
              </form>
              <div class="text-center">
                <a class="small" href="<?=site_url('auth')?>">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?=base_url()?>assets/template/vendor/jquery/jquery.min.js"></script>
  <script src="<?=base_url()?>assets/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?=base_url()?>assets/template/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?=base_url()?>assets/template/js/sb-admin-2.min.js"></script>

</body>

</html>
