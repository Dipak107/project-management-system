<html>
    <head>
    <?php
session_start();
if(!isset($_SESSION["email"]))
{
	header("location: index.php");
}
?>

<?php

 if(isset($_SESSION["role"]))
 {
	 if($_SESSION["role"]=='a')
	 {
		 ?>
 
        <title>ProLink</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <!-- VENDOR CSS -->
        <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/vendor/linearicons/style.css">
        <link rel="stylesheet" href="assets/vendor/chartist/css/chartist-custom.css">
        <!-- MAIN CSS -->
        <link rel="stylesheet" href="assets/css/main.css">
        <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
        <link rel="stylesheet" href="assets/css/demo.css">
        <!-- GOOGLE FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
        <!-- ICONS -->
        <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
        <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">

        <script src="assets/scripts/sweetalert.min.js"></script>

        <style>
            .panel{
                margin-top: 100px;
                margin-left: 200px;;
            }
            #adds{
                margin-top: -100px;
                margin-left: -150px;
            }
            #datatable{
                margin-left: 120px;
            }
            .container {
                padding: 2rem 0rem;

            }

            h4 {
                margin: 2rem 0rem 1rem;
            }

            .table-image {
                td, th {
                    vertical-align: middle;
                }
            }

        </style>
        <script>
            window.onload = function () {
                document.getElementById('togglebtn').click();
            }
        </script>
    </head>
    

    <body>
        <div class="container";>
            <?php
            include 'admindash.php';
            ?>

            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title"> <h3 class="panel-title">Add Student</h3></h3>
                    <div class="right">
                        <button type="button" id="togglebtn"   class="btn-toggle-collapse"><i class="lnr lnr-chevron-down"></i></button>

                    </div>
                </div>
                <div class="panel-body" id="adds">
                    <!-- INPUT GROUPS -->
                    <div class="panel">

                        <div class="panel-heading">
                            <h3 class="panel-title">Add Student</h3>
                        </div>
                        <form action="php/addstudent.php" method="post">
                            <div class="panel-body">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <label class="btn btn-primary" type="label">Enrollment</button>
                                    </span> 
                                    <input class="form-control" required="" type="text" name="enrollment" pattern="[0-9]{10,}" title="invalid Enrollment Number">
                                </div>
                                <br>

                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <label class="btn btn-primary" type="label">Name</button>
                                    </span> 
                                    <input class="form-control" required="" type="text" name="name" pattern="[a-zA-Z ]+" title="name should not contain number or characters" >
                                </div>
                                <br>

                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <label class="btn btn-primary" type="label">Course-ID</button>
                                    </span> 
                                    <select class="form-control" name="courseid">
                                        <?php
                                        include 'connection.php';
                                        session_start();
                                        $query = "select course_id,coursename from course where status='active'";
                                        $result = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <option value="<?php echo $row["course_id"]; ?>"><?php echo $row["coursename"]; ?></option>

                                        <?php }
                                        ?>
                                    </select>
                                </div>
                                <br>

                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <label class="btn btn-primary" type="label">Email-ID</button>
                                    </span> 
                                    <input class="form-control" required="" type="text" name="email" pattern=".+@gmail.com" title="invalid Email">
                                </div>
                                <br>

                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <label class="btn btn-primary" type="label">Contact</button>
                                    </span> 
                                    <input class="form-control" required="" type="text" name="contact" pattern="[9876][0-9]{9}" title="invalid Contact Number">
                                </div>
                                <br>

                                <button type="submit" class="btn btn-success" name="addstudent" style="margin-right: 20px;"><i class="fa fa-check-circle"></i> Add Student</button>
                            </div>
                        </form>
                    </div>
                    <!-- END INPUT GROUPS -->
                </div>
            </div>









            <!-- BASIC TABLE -->
            <div class="container" id="datatable">
                <div class="row">
                    <div class="col-12">
                        <form method="post" action="#" >
                            <div class="input-group">
                                <input type="text" name="search"  class="form-control" placeholder="Search ">
                                <span class="input-group-btn"><button type="submit" value="yes" name="searchbtn" class="btn btn-primary">Go</button></span>
                            </div>
                        </form>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Enrollment</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">CourseName</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'php/connection.php';

                                if (isset($_POST["searchbtn"])) {
                                    $s = $_POST["search"];
                                    $query = "select * from student,course where student.course_id=course.course_id and concat(name,email,enrollment,course.coursename) like '%$s%'";
                                } else {
                                    $query = "select * from student,course where student.course_id=course.course_id";
                                }

                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <tr>
                                        <td ><?php echo $row["enrollment"]; ?></td>
                                        <td><?php echo $row["name"]; ?></td>
                                        <td><?php echo $row["email"]; ?></td>
                                        <td><?php echo $row["coursename"]; ?></td>
                                <form action="php/studentoperation.php" method="post">
                                    <input type="hidden" value="<?php echo $row["enrollment"]; ?>" name="enrollment">


                                    <td>
                                        <button type="submit" value="edit" name="edit" class="btn btn-primary"><i class="">Edit</i></button>
                                        


                                        <?php
                                        echo "<button type='submit' value='delete' name='delete' class='btn btn-danger'  onClick=\"javascript: return confirm('Do you want to delete this record');\"><i class=''>Delete</i></button>";
                                        ?>   </td>
                                </form>

                                </tr>
                            <?php }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>






        <!-- Button trigger modal -->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                       <?php echo $_SESSION["editid"];?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>







        <?php
        if (isset($_SESSION["sadded"])) {
            if ($_SESSION["sadded"] == "yes") {
                $_SESSION["sadded"] = "no";
                ?>
                <script>

                    swal("Student added successfully");

                </script>
                <?php
            }
        }
        ?>



<?php
        if (isset($_SESSION["duplicates"])) {
            if ($_SESSION["duplicates"] == "yes") {
                $_SESSION["duplicates"] = "no";
                ?>
                <script>

                    swal("duplicate info not allowed (enrollment,email,contact should be unique)");

                </script>
                <?php
            }
        }
        ?>
    </body>
</html>

<?php
     }
    }
    ?>