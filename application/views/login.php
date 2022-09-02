<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/bootstrap.css' ?>">
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/style.css' ?>">
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/login.css' ?>">

  <title>Login</title>
</head>

<body>
  <main class="form-signin">
    <form method="post" action="<?php echo base_url() . 'auth/login' ?>" name="form" id="form">
      
      <?php if($this->session->flashdata('msg')) :?>
      <div class="alert alert-danger">
        <?= $this->session->flashdata('msg'); ?>
      </div>
      <?php endif; ?>

      <h1 class="h3 mb-3 fw-strong text-center">Please login</h1>

      <div class="form-floating">
        <input type="text" class="form-control <?php echo (form_error('email') != "") ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="name@example.com" value="<?php echo set_value('email') ?>">
        <label for="email">Email address</label>
        <p class="invalid-feedback d-block"><?php echo strip_tags(form_error('email')); ?></p>

      </div>
      <div class="form-floating">
        <input type="password" class="form-control <?php echo (form_error('password') != "") ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Password">
        <label for="password">Password</label>
        <p class="invalid-feedback d-block"><?php echo strip_tags(form_error('password')); ?></p>

      </div>


      <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
      
      <div class="mt-3">
        <a href="<?php echo base_url() . 'auth/register'; ?>" class="text-decoration-none ">Register here</a>
      </div>       
    </form>

  </main>
</body>

</html>