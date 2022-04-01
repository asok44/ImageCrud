<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/bootstrap.css' ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/style.css' ?>">
    
    <title>Register</title>
</head>

<body>
    <div class="container">
        <div class="col-md-6 mt-4">
        <?php if($this->session->flashdata('msg')):?>
            <div class="alert alert-success">
                <?= $this->session->flashdata('msg'); ?>
            </div>
        <?php endif; ?>
            <div class="card">
                <div class="card-header">
            <h3>Register here</h3>
            </div>
                <form action="<?php echo base_url() . 'auth/register' ?>" enctype="multipart/form-data" method="post" name="registerForm" id="registerForm">
                    <div class="card-body register">
                        <div class="form-group mb-3">
                            <label for="name">First Name</label>
                            <?php echo form_input(['class' => 'form-control', 'id' => 'firstname', 'name' => 'firstname', 'placeholder' => 'First Name', 'value' => set_value('firstname')]) ?>
                            <p class="invalid-feedback d-block"><?php echo strip_tags(form_error('firstname')); ?></p>

                        </div>
                        <div class="form-group mb-3">
                            <label for="name">Last Name</label>
                            <?php echo form_input(['class' => 'form-control', 'id' => 'lastname', 'name' => 'lastname', 'placeholder' => 'Last Name', 'value' => set_value('lastname')]) ?>
                            <p class="invalid-feedback d-block"><?php echo strip_tags(form_error('lastname')); ?></p>

                        </div>
                        <div class="form-group mb-3">
                            <label for="name">Email</label>
                            <?php echo form_input(['class' => 'form-control', 'id' => 'email', 'name' => 'email', 'placeholder' => 'Email', 'value' => set_value('email')]) ?>
                            <p class="invalid-feedback d-block"><?php echo strip_tags(form_error('email')); ?></p>

                        </div>
                        <div class="form-group mb-3">
                            <label for="name">Phone</label>
                            <?php echo form_input(['class' => 'form-control', 'id' => 'phone', 'name' => 'phone', 'placeholder' => 'Phone No.', 'value' => set_value('phone')]) ?>
                            <p class="invalid-feedback d-block"><?php echo strip_tags(form_error('phone')); ?></p>

                        </div>
                        <div class="form-group mb-3">
                            <label for="name">Password</label>
                            <?php echo form_password(['class' => 'form-control', 'id' => 'password', 'name' => 'password', 'placeholder' => 'Password']) ?>
                            <p class="invalid-feedback d-block"><?php echo strip_tags(form_error('password')); ?></p>

                        </div>
                        <div class="form-group mb-3">
                            <input type="file" class="form-control" id="image" name="image" ?>
                            <p class="invalid-feedback d-block"><?php if(isset($error)){echo strip_tags($error);}?></p>
                        </div>

                        <div class="form-group d-grid">
                            <?php echo form_submit(['class' => 'btn btn-primary', 'id' => 'submit', 'name' => 'submit', 'value' => 'Register Now']) ?>
                        </div>


                    </div>
                </form>
                <a href="<?php echo base_url() . 'auth/login'; ?>" class="mb-3 text-decoration-none">Login here</a>

            </div>
        </div>
    </div>
</body>

</html>