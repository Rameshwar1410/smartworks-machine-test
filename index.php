<?php
require_once 'import.php';
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">

    <!-- Datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.21/r-2.2.5/datatables.min.css" />

    <!-- Js file -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.21/r-2.2.5/datatables.min.js"></script>

    <!-- css -->
    <link rel="stylesheet" href="assets/css/import.css">
</head>

<body>

    <div class="container">

        <h2 class="text-center">Import CSV file</h2>
        <div id="response" class="<?php echo (!empty($type)) ? $type . " display-block" : ''; ?>">
            <?php echo $message ?? ''; ?>
        </div>

        <!-- Form -->
        <div class="row col-8 mt-5 jumbotron bg-secondary justify-content-md-center text-white">
            <form class="form-inline" action="" method="post" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
                <div class="input-row">
                    <span class="">Choose CSV File</span>&nbsp;
                    <input type="file" name="file" id="file" accept=".csv">
                    <button type="submit" id="submit" name="import" class="btn-submit btn btn-primary">Import</button>
                </div>
            </form>
        </div>

        <!-- Datatable -->
        <div class="row mt-5">
            <div class="col">
                <?php
                $sqlSelect = "SELECT * FROM users";
                $result = $db->select($sqlSelect);

                if (!empty($result)) { ?>
                    <table id='userTable' class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Age</th>
                                <th>Mobile Number</th>
                                <th>Address</th>
                                <th>Job</th>
                                <th>Company Name</th>
                                <th>Job</th>
                                <th>university</th>
                                <th>Marks</th>
                                <th>percentage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($result as $row) { ?>
                                <tr>
                                    <td><?php echo $row['first_name']; ?></td>
                                    <td><?php echo $row['last_lame']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['age']; ?></td>
                                    <td><?php echo $row['mobile_number']; ?></td>
                                    <td><?php echo $row['address']; ?></td>
                                    <td><?php echo $row['job']; ?></td>
                                    <td><?php echo $row['company_name']; ?></td>
                                    <td><?php echo $row['university']; ?></td>
                                    <td><?php echo $row['collage_name']; ?></td>
                                    <td><?php echo $row['marks']; ?></td>
                                    <td><?php echo $row['percentage']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>

            </div>
        </div>
    </div>

    <script src="assets/js/form.js"></script>
</body>

</html>