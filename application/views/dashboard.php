<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/bootstrap.css' ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/style.css' ?>">

    <title>Dashboard</title>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="col-bg-5 text-right text-white">
                Welcome, <?php echo $users['firstname'] . ' ' . $users['lastname']; ?> <a href="<?php echo base_url() . 'auth/logout'; ?>" class="nav-item btn btn-danger text-white text-decoration-none">Logout</a>
            </div>
        </div>
    </nav>

    <main class="container mt-4">
        <div class="pt-5">
            <a class="btn btn-info text-white" href="<?= base_url() . 'auth/display' ?>" role="button">View Users</a>
        </div>
    </main>

</body>

</html>