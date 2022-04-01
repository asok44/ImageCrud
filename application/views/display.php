<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/bootstrap.css' ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/style.css' ?>">

    <title>Display Users</title>
</head>

<body>
    <div class="container mt-3">
        <h3>Users Info</h3>
        <table class="table-bordered table">
            <thead class="text-center">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Image</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $item) : ?>
                    <tr class="text-center">
                        <td><?= $item->id ?></td>
                        <td><?= $item->firstname . ' ' . $item->lastname ?></td>
                        <td><?= $item->email ?></td>
                        <td><?= $item->phone ?></td>
                        <td><img src="<?= base_url('image/' . $item->filename) ?>" height="40px" width="40px" alt="User Image"></td>
                        <td><a href="<?= base_url('auth/edit/' . $item->id) ?>" class="btn btn-success">Edit</a></td>
                        <td><a href="<?= base_url('auth/delete/' . $item->id) ?>" class="btn btn-danger">Delete</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div>
            <a href="<?= base_url('auth/dashboard') ?>" class="btn btn-primary">Dashboard</a>
        </div>
    </div>
</body>

</html>