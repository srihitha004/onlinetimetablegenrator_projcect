<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>PROGRAM GENERATOR</title>
    <!-- BOOTSTRAP CORE STYLE CSS -->
    <link href="./assets/css/bootstrap.css" rel="stylesheet">
    <!-- FONT AWESOME CSS -->
    <link href="./assets/css/font-awesome.min.css" rel="stylesheet">
    <!-- FLEXSLIDER CSS -->
    <link href="./assets/css/flexslider.css" rel="stylesheet">
    <!-- CUSTOM STYLE CSS -->
    <link href="./assets/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="navbar navbar-inverse navbar-fixed-top" id="menu">
        <div class="container">
            <div align="center">
                <h3 align="center">COMPUTER SCIENCE PROGRAM GENERATOR</h3>
            </div>
        </div>
    </div>

    <div class="carousel-inner">
        <div align="center" style="margin-top: 30px">
            <button id="teacherLoginBtn" class="btn btn-info btn-lg">TEACHER LOGIN</button>
            <button id="adminLoginBtn" class="btn btn-success btn-lg">ADMIN LOGIN</button>
        </div>
        <br>
        <div align="center">
            <form action="studentvalidation.php" method="post">
                <select id="select_semester" name="select_semester" class="list-group-item">
                    <option selected disabled>Select Semester</option>
                    <option value="1">1 Year ( Semester 1 )</option>
                    <option value="2">1 Year ( Semester 2 )</option>
                    <option value="3">2 Year ( Semester 3 )</option>
                    <option value="4">2 Year ( Semester 4 )</option>
                    <option value="5">3 Year ( Semester 5 )</option>
                    <option value="6">3 Year ( Semester 6 )</option>
                    <option value="7">4 Year ( Semester 7 )</option>
                    <option value="8">4 Year ( Semester 8 )</option>
                </select>
                <button type="submit" class="btn btn-info btn-lg" style="margin-top: 10px">View</button>
            </form>
        </div>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close">&times;</span>
                    <h2 id="popupHead">Modal Header</h2>
                </div>
                <div class="modal-body" id="LoginType">
                    <div style="display:none" id="adminForm">
                        <form action="adminFormvalidation.php" method="POST">
                            <div class="form-group">
                                <label for="adminname">Username</label>
                                <input type="text" class="form-control" id="adminname" name="UN">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="PASS">
                            </div>
                            <div align="right">
                                <input type="submit" class="btn btn-default" name="LOGIN" value="LOGIN">
                                <button type="button" class="btn btn-default" id="adminSignUpBtn">SIGN UP</button>
                            </div>
                        </form>
                    </div>
                    <div style="display:none" id="adminSignUpForm">
                        <form action="adminSignup.php" method="POST">
                            <div class="form-group">
                                <label for="newadminname">Username</label>
                                <input type="text" class="form-control" id="newadminname" name="UN">
                            </div>
                            <div class="form-group">
                                <label for="newpassword">Password</label>
                                <input type="password" class="form-control" id="newpassword" name="PASS">
                            </div>
                            <div align="right">
                                <input type="submit" class="btn btn-default" name="SIGNUP" value="SIGN UP">
                            </div>
                        </form>
                    </div>
                </div>
                <div style="display:none" id="facultyForm">
                    <form action="teacherform.php" method="POST" style="overflow: hidden">
                        <div class="form-group">
                            <label for="facultyname">Teacher's Name</label>
                            <input type="text" class="form-control" id="facultyname" name="TN" placeholder="Teacher Name">
                        </div>
                        <div class="form-group">
                            <label for="facultyno">Teacher's ID</label>
                            <input type="text" class="form-control" id="facultyno" name="FN" placeholder="T...">
                        </div>
                        <div align="right">
                            <button type="submit" class="btn btn-default" name="LOGIN">LOGIN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            var modal = document.getElementById('myModal');
            var teacherLoginBtn = document.getElementById("teacherLoginBtn");
            var adminLoginBtn = document.getElementById("adminLoginBtn");
            var heading = document.getElementById("popupHead");
            var facultyForm = document.getElementById("facultyForm");
            var adminForm = document.getElementById("adminForm");
            var adminSignUpForm = document.getElementById("adminSignUpForm");
            var adminSignUpBtn = document.getElementById("adminSignUpBtn");
            var span = document.getElementsByClassName("close")[0];

            adminLoginBtn.onclick = function() {
                modal.style.display = "block";
                heading.innerHTML = "Admin Login";
                adminForm.style.display = "block";
                adminSignUpForm.style.display = "none";
                facultyForm.style.display = "none";
            }
            adminSignUpBtn.onclick = function() {
                adminForm.style.display = "none";
                adminSignUpForm.style.display = "block";
            }
            teacherLoginBtn.onclick = function() {
                modal.style.display = "block";
                heading.innerHTML = "Faculty Login";
                facultyForm.style.display = "block";
                adminForm.style.display = "none";
                adminSignUpForm.style.display = "none";
            }
            span.onclick = function() {
                modal.style.display = "none";
                adminForm.style.display = "none";
                facultyForm.style.display = "none";
                adminSignUpForm.style.display = "none";
            }
        </script>

        <script src="./assets/js/jquery-1.10.2.js"></script>
        <script src="./assets/js/bootstrap.min.js"></script>
        <script src="./assets/js/jquery.flexslider.min.js"></script>
        <script src="./assets/js/scrollreveal.min.js"></script>
        <script src="./assets/js/jquery.easing.min.js"></script>
    </div>
</body>
</html>
