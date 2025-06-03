<?php
require_once('functions.php');
$conn = mysqli_connect("localhost:3306", "root", "password", "tubes");

function getUsers()
{

    $users = query("SELECT * FROM users");
    return $users;
}


function deleteUser($id)
{
    global $conn;

    // Menghapus pengguna dari tabel users
    $query = "DELETE FROM users WHERE id = $id";
    mysqli_query($conn, $query);
}

if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];

    deleteUser($deleteId);

    echo "<script>alert('User deleted successfully');</script>";
}

$users = getUsers();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin User</title>
    <link rel="stylesheet" href="../assets/css/navbwah.css" />
    <link rel="stylesheet" href="../assets/css/slider.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/6dd84d01cb.js" crossorigin="anonymous"></script>
    <style>
        /* Styling for mobile devices */
        @media only screen and (max-width: 767px) {
            body {
                padding-top: 30px !important;
            }

            .table-responsive {
                overflow-x: scroll;
                -webkit-overflow-scrolling: touch;
            }

            table {
                min-width: 600px;
            }

            .table-responsive {
                max-height: 60vh;
                overflow-y: auto;
            }

            form.cari input {
                width: 90px !important;
            }
        }

        /* Styling for tablets */
        @media only screen and (min-width: 768px) and (max-width: 991px) {
            body {
                padding-top: 40px !important;
            }
        }

        /* Styling for small desktops */
        @media only screen and (min-width: 992px) and (max-width: 1199px) {
            body {
                padding-top: 50px !important;
            }
        }

        /* Styling for larger desktops */
        @media only screen and (min-width: 1200px) {
            body {
                padding-top: 60px !important;
            }
        }

        /* Basic styling */
        body {
            background-color: #f4f4f4;
            color: #333;
            font-family: Consolas, monospace;
            font-size: 14px;
            line-height: 1.5;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .table.table-bordered {
            border: 1px solid #ccc;
            border-collapse: collapse;
        }

        p {
            margin: 10px 0;
            font-size: 16px;
        }

        thead {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        a {
            color: #333;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        @media print {

            .no-print,
            .no-print * {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <?php include('../tambahanlain/navadmin.php') ?>
    <section>

        <h1 class="mt-3">Admin User</h1>
        <div class="table-responsive">
            <table class="table table-bordered">
                <div class="row">
                    <div class="col-12">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user) : ?>
                                <tr>
                                    <td><?= $user['id']; ?></td>
                                    <td><?= $user['username']; ?></td>
                                    <td>
                                        <a class="btn btn-danger" href="AdminUser.php?delete_id=<?= $user['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </div>
            </table>
        </div>
        </div>
    </section>
    <!-- nav hp -->
    <?php include('../tambahanlain/navbarhpadmin.php') ?>
    <!-- nav hp end -->

</body>
<script src="https://kit.fontawesome.com/6dd84d01cb.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQ