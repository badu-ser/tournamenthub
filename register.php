<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate inputs
        if (empty($_POST['l_nickname']) || empty($_POST['l_email']) || empty($_POST['l_cid']) || empty($_POST['l_phone']) || empty($_POST['crew']) || empty($_POST['p2']) || empty($_POST['p3']) || empty($_POST['p4']) || !filter_var($_POST['l_email'], FILTER_VALIDATE_EMAIL)) {
                echo "No arguments Provided!";
                        exit;
                            }

                                // Assign form data to variables
                                    $l_nickname = $_POST['l_nickname'];
                                        $l_email = $_POST['l_email'];
                                            $l_cid = $_POST['l_cid'];
                                                $l_phone = $_POST['l_phone'];
                                                    $crew = $_POST['crew'];
                                                        $p2 = $_POST['p2'];
                                                            $p3 = $_POST['p3'];
                                                                $p4 = $_POST['p4'];
                                                                    $payment = 'Not Paid';

                                                                        // Database connection details
                                                                            $servername = "sql313.byetcluster.com"; // Your server name
                                                                                $username = "if0_38226882"; // Your database username
                                                                                    $password = "vPwSH5XcSms"; // Replace with your actual database password
                                                                                        $dbname = "if0_38226882_register"; // Your database name

                                                                                            // Create connection
                                                                                                $conn = new mysqli($servername, $username, $password, $dbname);

                                                                                                    // Check connection
                                                                                                        if ($conn->connect_error) {
                                                                                                                die("Connection failed: " . $conn->connect_error);
                                                                                                                    }

                                                                                                                        // Check if the CID already exists
                                                                                                                            $stmt = $conn->prepare("SELECT * FROM register WHERE l_cid = ?");
                                                                                                                                $stmt->bind_param("s", $l_cid);
                                                                                                                                    $stmt->execute();
                                                                                                                                        $stmt->store_result();
                                                                                                                                            $count = $stmt->num_rows;
                                                                                                                                                $stmt->close();

                                                                                                                                                    if ($count > 0) {
                                                                                                                                                            // Redirect if CID already exists
                                                                                                                                                                    header("Location: fail.html");
                                                                                                                                                                            exit;
                                                                                                                                                                                } else {
                                                                                                                                                                                        // Insert new registration
                                                                                                                                                                                                $stmt = $conn->prepare("INSERT INTO register (crew, l_nickname, l_email, l_phone, l_cid, p2, p3, p4, payment) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                                                                                                                                                                                                        $stmt->bind_param("sssssssss", $crew, $l_nickname, $l_email, $l_phone, $l_cid, $p2, $p3, $p4, $payment);

                                                                                                                                                                                                                if ($stmt->execute()) {
                                                                                                                                                                                                                            // Redirect on success
                                                                                                                                                                                                                                        header("Location: success.html");
                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                            // Display error if insertion fails
                                                                                                                                                                                                                                                                        echo "Error: " . $stmt->error;
                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                        $stmt->close();
                                                                                                                                                                                                                                                                                            }

                                                                                                                                                                                                                                                                                                // Close connection
                                                                                                                                                                                                                                                                                                    $conn->close();
                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                    ?>