<?php
session_start();

$connect = mysqli_connect("localhost", "root", "", "voting");

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}


$userdata = $_SESSION['userdata'];
$groupdata = $_SESSION['groupdata'];

$voterNames = '';

$sql = "SELECT * FROM user WHERE role = 1";
$result = mysqli_query($connect, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $voterNames .= "<div class='voter-name'>Name: " . htmlspecialchars($row["name"]) . "</div>";
        }
    } else {
        $voterNames = "<div class='voter-name'>0 results</div>";
    }
} else {
    die("Error executing query: " . mysqli_error($connect));
}

$sql1 = "SELECT * FROM user";
$res1 = mysqli_query($connect, $sql1);

$tableData = '';

if ($res1) {
    if (mysqli_num_rows($res1) > 0) {
        $tableData .= "<table border='1'><tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Password</th>
                        <th>Address</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Votes</th>
                        <th>Group Name</th>
                       </tr>";
        while ($row = mysqli_fetch_assoc($res1)) {
            $tableData .= "<tr>
                            <td>" . htmlspecialchars($row['id']) . "</td>
                            <td>" . htmlspecialchars($row['name']) . "</td>
                            <td>" . htmlspecialchars($row['mobile']) . "</td>
                            <td>" . htmlspecialchars($row['password']) . "</td>
                            <td>" . htmlspecialchars($row['address']) . "</td>
                            <td>" . htmlspecialchars($row['role']) . "</td>
                            <td>" . htmlspecialchars($row['status']) . "</td>
                            <td>" . htmlspecialchars($row['votes']) . "</td>
                            <td>" . htmlspecialchars($row['grpname']) . "</td>
                           </tr>";
                        
        }
        $tableData .= "</table>";
    } else {
        $tableData = "0 results";
    }
} else {
    die("Error executing query: " . mysqli_error($connect));
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Voting System - Dashboard</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
</head>
<body>
    <style>
        #logoutbtn {
            padding: 10px;
            font-size: 15px;
            border-radius: 5px;
            background-color: #3498db;
            color: white;
            float: right;
            margin: 10px;
        }
        #show {
            display: none;
        }
        #search {
            margin-bottom: 10px;
            padding: 10px;
            font-size: 15px;
            width: 20%;
        }
        .voter-name {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        #tableContainer{
            display: none;
        }
    </style>

    <div id="mainsection">
        <center>
            <div id="headerSection">
                <a href="logout.php"><button id="logoutbtn">Logout</button></a>
                <h1>Online Voting System</h1>
                <br>
                <button id="vote">Voters</button>
            </div>
            <div id="show">
                <input type="text" id="search" placeholder="Search for names...">
                <div id="voterNamesContainer">
                    <?php 
                    echo $voterNames; 
                    ?>
                </div>
                
            </div>
        </center>
    </div>
    <div id="tableContainer">
                    <?php echo $tableData; 
                    ?>
                </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("vote").addEventListener("click", function() {
                document.getElementById("show").style.display = "block";
            });

            document.getElementById("search").addEventListener("input", function() {
                var filter = this.value.toLowerCase();
                var voterNames = document.getElementsByClassName("voter-name");

                for (var i = 0; i < voterNames.length; i++) {
                    var name = voterNames[i].innerText.toLowerCase();
                    if (name.includes(filter)) {
                        voterNames[i].style.display = "";
                    } else {
                        voterNames[i].style.display = "none";
                    }
                }
            });
        });
    </script>
</body>
</html>
