<?php
    session_start();
    if(!isset($_SESSION['userdata'])){
        header("location: ../") ;    //back to login page
    }
    
    $userdata=$_SESSION['userdata'];
    $groupdata=$_SESSION['groupdata'];

    if($_SESSION['userdata']['status']==0){
        $status='<b style="color:red">Not Voted</b>';
    }
    else{
        $status='<b style="color:green">Voted</b>';
    }

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
        #backbtn{
            padding: 10px;
            font-size: 15px;
            border-radius: 5px;
            background-color:#3498db;
            color: white;
            float: left;
            margin: 10px;
        }
        #logoutbtn{
            padding: 10px;
            font-size: 15px;
            border-radius: 5px;
            background-color:#3498db;
            color: white;
            float: right;
            margin: 10px;
        }

        #Profile{
            background-color:white;
            width: 30%;
            padding: 10px;
            float:left;
        }

        #Group{
            background-color:white;
            width: 60%;
            padding: 10px;
            float:right;
        }

        #votebtn{
            padding: 10px;
            font-size: 15px;
            border-radius: 5px;
            background-color:#3498db;
            color: white;
        }

        #mainpanel{
            padding: 10px;
        }

        #voted{
            padding: 10px;
            font-size: 15px;
            border-radius: 5px;
            background-color: green;
            color: white;
        }
        
        
    </style>

    <div id="mainsection">
        <center>
        <div id="headerSection">
            <a href="../"><button id="backbtn"> Back</button></a> 
            <a href="logout.php"><button id="logoutbtn"> Logout</button></a>    
            <h1>Online Voting System<h1>
        </div>
    </center>
        <hr>

        <div id="mainpanel">
        <div id="Profile">
            <center><img src="../uploads/<?php echo $userdata['photo']?>" height="100" width="100"></center><br><br>
            <b>Name:</b> <?php echo $userdata['name']?> <br><br>
            <b>Mobile</b> <?php echo $userdata['mobile']?> <br><br>
            <b>Address:</b> <?php echo $userdata['address']?> <br><br>
            <b>Status:</b> <?php echo $status?> <br><br>
        </div>

        <div id="Group">
            <?php
                if($_SESSION['groupdata']){
                    for($i=0; $i<count($groupdata); $i++){
                        ?>
                        <div>
                            <img style="float: right" src="../uploads/<?php echo $groupdata[$i]['photo'] ?>" height="100" width="100">
                            <b>Group Name: <?php echo $groupdata[$i]['name']?> </b><br><br>
                            <br><br>
                            <form action="../api/vote.php" method="POST">
                                <input type="hidden" name="gvotes" value="<?php echo $groupdata[$i]['votes'] ?>" id="gvotes">
                                <input type="hidden" name="gid" value="<?php echo $groupdata[$i]['id'] ?>" id="gid">
                                <input type="hidden" name="groupname" value="BJP" id="groupname">
                                <input type="hidden" name="groupname" value="CONGRESS" id="groupname">
                                <input type="hidden" name="groupname" value="AAP" id="groupname">
                                <?php
                                    if($_SESSION['userdata']['status']==0){
                                        ?>
                                        <input type="submit" name="votebtn" value="Vote" id="votebtn">
                                        <?php 
                                    }
                                    else{
                                        ?>
                                        <button disabled type="button" name="votebtn" value="Vote"id="voted" >Voted</button>
                                        <!--
                                        <script>
                                            if(document.getElementById(gid).value==document.getElementById(gvotes).value){
                                                if(document.getElementById(gvotes).value==11){
                                                    document.getElementById(result).value=document.getElementById(groupname).value;
                                                }
                                                else if(document.getElementById(gvotes).value==12){
                                                    document.getElementById(result).value=document.getElementById(groupname).value;
                                                }
                                                else if(document.getElementById(gvotes).value==13){
                                                    document.getElementById(result).value=document.getElementById(groupname).value;
                                                }
                                    }-->
                                        <?php 
                                    }
                                    ?>
                            </form>
                        </div>
                        <hr> 
                        <?php
                    }
                }
                else {

                }
            ?>
        </div>
    </div>
        </div>
        
</body>
</html>