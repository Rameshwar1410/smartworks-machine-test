<?php

use ImportCsv\DataSource;

require_once 'DataSource.php';
require_once 'importConstant.php';

$db = new DataSource();
$conn = $db->getConnection();

// process csv file.

if (isset($_POST["import"])) {
    $fileName = $_FILES["file"]["tmp_name"];

    if ($_FILES["file"]["size"] > 0) {
        $file = fopen($fileName, "r");
        $row = 0;

        while (($data = fgetcsv($file, 10000, ",")) !== FALSE) {
            // check for first row and contain fields 
            $row++;
            if ($row == 1) {
                $data = array_map('strtolower', $data);

                if (array_slice($data, 0, 5) !== REQUIRE_FIELDS) {
                    $type = "error";
                    $message = 'Given fields are mismatch. Required fields are ' . implode(',', REQUIRE_FIELDS);
                    break;
                }

                continue;
            }

            // check for required field
            if (in_array(null, array_slice($data, 0, 5), true) || in_array('', array_slice($data, 0, 5), true)) {
                $type = "error";
                $message = 'Given fields are required ' . implode(',', REQUIRE_FIELDS);
                break;
            }

            // escape value
            for ($i = 0; $i < 12; $i++) {
                $paramArray[] =  $conn->real_escape_string($data[$i]) ?? null;
            }

            // create query
            $paramType = "ssssssssssss";
            $sqlInsert = "INSERT INTO users (" . implode(',', TABLE_COLUMNS) . ") values (?,?,?,?,?,?,?,?,?,?,?,?)";
            $insertId = $db->insert($sqlInsert, $paramType, $paramArray);


            // set message
            if (!empty($insertId)) {
                $type = "success";
                $message = "CSV Data Imported into the Database";
            } else {
                $type = "error";
                $message = "Problem in Importing CSV Data";
            }

            $paramArray = [];
        }
    }
}
