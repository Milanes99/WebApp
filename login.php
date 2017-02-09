<html>
<head>
  <title>Login</title>
    <meta http-equip = "Content-Type" content ="text/html; charset = ISO-8859-1">
    <link rel ="stylesheet" type = "text/css" href = "style.css">
    <title>Any Co.: $title</title>

  <style>
form {
    border: 3px solid black;
}
input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}
.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
  }
.container {
    padding: 30px;
}
span.psw {
    float: right;
    padding-top: 16px;
}
body {
    background-color: skyblue;
}

.imgcontainer {
    text-align: center;
    margin: 50px 0 12px 0;
}
img.avatar {
    width: 30%;
    border-radius: 45%;
}
</style>
</head>
<body>
<h1>Login</h1>
<form method="post", action="#">
  <div class="imgcontainer"> 
    <img src="avatar.png" alt="Avatar" class="avatar">
  </div>
  <div class="container">
    <label>Employees-ID :</label>
    <input type="text", name="username", placeholder="Enter Username"/> <br>
    <label>E-MAIL :</label>
    &nbsp<input type="password", name="password", placeholder="Enter Password"/> <br>
    <input type="submit", name="submit",value="submit"/> <br>
</div>
  </form>
    <?php 
     require('anyco_ui.inc');
    $c = oci_connect('hr','hr','localhost/xe');
    ui_print_footer(date('Y-m-d H:i:s'));
    if (!$c) {
            $e = oci_error();
                trigger_error('Could not Connect to Database:'. $e['message'], E_USER_ERROR);
        }   
          if(isset($_POST['submit'])){
           $c_username = addslashes($_POST['username']);
           $c_password= addslashes($_POST['password']);
           $sel_c = "select * from EMPLOYEES where EMAIL = '".$c_password ."' AND EMPLOYEE_ID='".$c_username."'";
           $run_c = oci_parse($c,$sel_c);
           $exec = oci_execute($run_c);
           $arr = oci_fetch_array($run_c);
           $check_num = oci_num_rows($run_c);
           if ($check_num == 0 ) {
                echo "<script>alert('username or password is incorrect')</script>";
           }else{
            header("Location: anyco.php");
           }
        }
     ?>

</body>
</html>


