<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['agmsaid'] == 0)) {
    header('location:logout.php');
} else {

    // Fetch contact form submissions from tblcontact
    $query = "SELECT Name, Email, ContactNo, Message, SubmitDate FROM tblcontact";
    $result = mysqli_query($con, $query);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <link rel="shortcut icon" href="img/favicon.png">
        <title>Contact Submissions | Art Gallery Management System</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-theme.css" rel="stylesheet">
        <link href="css/elegant-icons-style.css" rel="stylesheet" />
        <link href="css/font-awesome.min.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet">
        <link href="css/style-responsive.css" rel="stylesheet" />

        <!-- DataTables CSS -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
        <link rel="stylesheet" href="../datatableAsset/datatables.min.css">
        <link rel="stylesheet" href="../datatableAsset/datatables.css">
    </head>

    <body>
        <section id="container" class="">
            <?php include_once('includes/header.php'); ?>
            <?php include_once('includes/sidebar.php'); ?>

            <!-- Main Content Section -->
            <section id="main-content">
                <section class="wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    Contact Form Submissions
                                </header>
                                <div class="panel-body">
                                    <!-- Contact Submissions Data Table -->
                                    <table id="contactTable" class="display">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Contact No</th>
                                                <th>Message</th>
                                                <th>Submit Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Loop through the result set and display the data in the table
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<tr>";
                                                echo "<td>" . $row['Name'] . "</td>";
                                                echo "<td>" . $row['Email'] . "</td>";
                                                echo "<td>" . $row['ContactNo'] . "</td>";
                                                echo "<td>" . $row['Message'] . "</td>";
                                                echo "<td>" . $row['SubmitDate'] . "</td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </section>
                        </div>
                    </div>
                </section>
            </section>

            <?php include_once('includes/footer.php'); ?>
        </section>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- DataTables JS -->
        <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script> -->
        <script src="../datatableAsset/datatables.js"></script>
        <script src="../datatableAsset/datatables.min.js"></script>
        <script>
            $(document).ready(function() {
                // Initialize DataTables
                $('#contactTable').DataTable();
            });
        </script>
    </body>

    </html>
<?php } ?>