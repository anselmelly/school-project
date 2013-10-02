<?php
session_start();
if (!$_SESSION['email']) {
    header('location: login-form.php');
    exit;
}
?>
<?php
include 'common/header.php';
include 'common/connection-db.php';

if ($_POST) {
    error_reporting(E_ERROR);
    $first_name = htmlspecialchars($_POST['firstname']);
    $last_name = htmlspecialchars($_POST['lastname']);
    $pwd = htmlspecialchars($_POST['pwd']);
    $gender = htmlspecialchars($_POST['sex']);
    $dob = date("Y-m-d", strtotime(htmlspecialchars($_POST['datepicker'])));
    $country = htmlspecialchars($_POST['country']);
    $dept = htmlspecialchars($_POST['dept']);


    $error = 0;
    $msg = '';
    $fields = "first_name='" . $first_name . "'," .
            "last_name='" . $last_name . "'," .
            "gender='" . $gender . "'," .
            "dob='" . $dob . "'," .
            "country='" . $country . "'," .
            "dept='" . $dept . "',";


    if ($first_name == "" || $last_name == "" || $gender == "" || $dob == "" ||
            $country == "" || $dept == "") {
        $msg .= "Form dont submit!!!!<br/>";
        $error = 1;
    }

    if ($pwd) {
        if (strlen($pwd) < 6) {
            $msg .= "password must be at least six digit <br/>";
            $error = 1;
        }
        $fields.= "password='" . $pwd . "',";
    }

    $fname = '';
    if (isset($_FILES["photo"]["name"])) {



        // image upload
        $uploads_dir = 'upload';
        $allowedExts = array("jpg", "jpeg", "gif", "png");
        $extension = end(explode(".", $_FILES["photo"]["name"]));

        if ($_FILES["photo"]["type"] == "image/gif" || $_FILES["photo"]["type"] == "image/jpg" || $_FILES["photo"]["type"] == "image/jpeg" || $_FILES["photo"]["type"] == "image/png" && $_FILES["photo"]["size"] < 2500000 && in_array($extension, $allowedExts)) {

            if ($_FILES["photo"]["error"] > 0) {

                echo "Error: " . $_FILES["photo"]["error"] . "<br />";
            } else {

                $fname = rand(1002, 102124) . $_FILES["photo"]["name"];
                $move = move_uploaded_file($_FILES['photo']['tmp_name'], "$uploads_dir/$fname");
                if ($move) {
                    echo "";
                } else {
                    echo "image uplaod fail";
                }
            }
        } else {

            echo "Invalid file type";
        }

        $sql1 = "SELECT photo FROM registration WHERE email = '" . $_SESSION['email'] . "'";
        $query1 = mysql_query($sql1) or die(mysql_errno());
        $image = mysql_fetch_array($query1);
        @unlink('upload/' . $image['photo']);
        $fields.= "photo='" . $fname . "',";
    }




    if (!$error) {

        $fields = trim($fields, ',');
        $sql = "UPDATE registration SET " .
                $fields .
                " where email='" . $_SESSION['email'] . "'";

        $query = mysql_query($sql) or die(mysql_errno());
        if ($query)
            echo "Profile update successfuly";
    }
    else
        echo $msg;
}

if ($_GET['id']) {
    $query = "SELECT * FROM registration where id='" . $_GET['id'] . "' limit 1";
    $result = mysql_query($query) or die(mysql_error());
    $row = mysql_fetch_assoc($result);
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $email = $row['email'];
    $gender = $row['gender'];
    $dob = $row['dob'];
    $country = $row['country'];
    $dept = $row['dept'];
    $photo = $row['photo'];
}
?>

<script>
    $(document).ready(function() {
        $( "#registration" ).validate({
            rules: {
                "firstname":{
                    required: true
                },
                "lastname":{
                    required: true
                },
                
                "pwd":{
                    minlength: 6
                },
                
                "repwd": {
                    equalTo: "#pwd" 
                },

                "sex":{
                    required: true
                },
                "datepicker":{
                    required: true
                },
                "country":{
                    required: true
                },
                "dept":{
                    required: true
                }
            },

            messages: {
                "firstname": {
                    required: "Please, enter your first name"
                },
                "lastname": {
                    required: "Please, enter your last name"
                },
                "pwd": {
                    required: "Please, enter your password"
                },
                "repwd": {
                    required: "Please, re enter password"
                },
                "sex": {
                    required: "Please, select your gender"
                },
                
                "datepicker": {
                    required: "Please, enter your date"
                },
                "country":{
                    required: "Please, select your country"
                },
                "dept":{
                    required: "Please, select your department"
                }
               
                
            }
        });
    });
</script>

<div class="row" style="width: 550px; margin: 0 auto;">

    <?php //if(isset($_GET['msg'])):          ?>
    <!--    <div class="alert alert-error danger">  
            <a class="close" data-dismiss="alert">×</a>  
            <strong>Error!</strong><?php //echo $_GET['msg'];                 ?>
        </div> -->
    <?php //endif;          ?>
    <form action="" method="POST" id="registration" class="form-horizontal" role="form" enctype="multipart/form-data">
        <div class="form-group">
            <label for="fristname" class="col-lg-4 control-label">First Name</label>
            <div class="col-lg-8">
                <input  type="text" name="firstname"  class="form-control" id="fristname" placeholder="First Name" value="<?php echo $first_name; ?>">

            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-lg-4 control-label">Last Name</label>
            <div class="col-lg-8">
                <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Last Name" value="<?php echo $last_name; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="eamil" class="col-lg-4 control-label">Email</label>
            <div class="col-lg-8">
                <input type="email" name="email" class="form-control" id="email" placeholder="Email" readonly  value="<?php echo $email; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="password"  class="col-lg-4 control-label">Password</label>
            <div class="col-lg-8">
                <input type="password" name="pwd" class="form-control" id="pwd" placeholder="Password" value="">
            </div>
        </div>

        <div class="form-group">
            <label for="password"  class="col-lg-4 control-label">Retype Password</label>
            <div class="col-lg-8">
                <input type="password" name="repwd" class="form-control" id="repwd" placeholder="Password">
            </div>
        </div>

        <div class="form-group">
            <label for="gender"  class="col-lg-4 control-label">Gender</label>
            <div class="col-lg-8">
                <input type="radio" name="sex" value="male" <?php if ($gender == 'male') echo ' checked'; ?>> Male
                <input type="radio" name="sex" value="female" <?php if ($gender == 'female') echo ' checked'; ?> > Female
            </div>     
        </div>
        <div class="form-group">
            <label for="dateofbirth" class="col-lg-4 control-label">Date of birth</label>
            <div class="col-lg-8">
                <input type="text" id="datepicker" name="datepicker" class="form-control"  placeholder="Date of birth" value="<?php echo $dob; ?>" >
            </div>
        </div>
        <div class="form-group">
            <label for="country" class="col-lg-4 control-label">Country</label>
            <div class="col-lg-8">

                <?php
                $country_list = array(
                    "Afghanistan",
                    "Albania",
                    "Algeria",
                    "Andorra",
                    "Angola",
                    "Antigua and Barbuda",
                    "Argentina",
                    "Armenia",
                    "Australia",
                    "Austria",
                    "Azerbaijan",
                    "Bahamas",
                    "Bahrain",
                    "Bangladesh",
                    "Barbados",
                    "Belarus",
                    "Belgium",
                    "Belize",
                    "Benin",
                    "Bhutan",
                    "Bolivia",
                    "Bosnia and Herzegovina",
                    "Botswana",
                    "Brazil",
                    "Brunei",
                    "Bulgaria",
                    "Burkina Faso",
                    "Burundi",
                    "Cambodia",
                    "Cameroon",
                    "Canada",
                    "Cape Verde",
                    "Central African Republic",
                    "Chad",
                    "Chile",
                    "China",
                    "Colombi",
                    "Comoros",
                    "Congo (Brazzaville)",
                    "Congo",
                    "Costa Rica",
                    "Cote d'Ivoire",
                    "Croatia",
                    "Cuba",
                    "Cyprus",
                    "Czech Republic",
                    "Denmark",
                    "Djibouti",
                    "Dominica",
                    "Dominican Republic",
                    "East Timor (Timor Timur)",
                    "Ecuador",
                    "Egypt",
                    "El Salvador",
                    "Equatorial Guinea",
                    "Eritrea",
                    "Estonia",
                    "Ethiopia",
                    "Fiji",
                    "Finland",
                    "France",
                    "Gabon",
                    "Gambia, The",
                    "Georgia",
                    "Germany",
                    "Ghana",
                    "Greece",
                    "Grenada",
                    "Guatemala",
                    "Guinea",
                    "Guinea-Bissau",
                    "Guyana",
                    "Haiti",
                    "Honduras",
                    "Hungary",
                    "Iceland",
                    "India",
                    "Indonesia",
                    "Iran",
                    "Iraq",
                    "Ireland",
                    "Israel",
                    "Italy",
                    "Jamaica",
                    "Japan",
                    "Jordan",
                    "Kazakhstan",
                    "Kenya",
                    "Kiribati",
                    "Korea, North",
                    "Korea, South",
                    "Kuwait",
                    "Kyrgyzstan",
                    "Laos",
                    "Latvia",
                    "Lebanon",
                    "Lesotho",
                    "Liberia",
                    "Libya",
                    "Liechtenstein",
                    "Lithuania",
                    "Luxembourg",
                    "Macedonia",
                    "Madagascar",
                    "Malawi",
                    "Malaysia",
                    "Maldives",
                    "Mali",
                    "Malta",
                    "Marshall Islands",
                    "Mauritania",
                    "Mauritius",
                    "Mexico",
                    "Micronesia",
                    "Moldova",
                    "Monaco",
                    "Mongolia",
                    "Morocco",
                    "Mozambique",
                    "Myanmar",
                    "Namibia",
                    "Nauru",
                    "Nepal",
                    "Netherlands",
                    "New Zealand",
                    "Nicaragua",
                    "Niger",
                    "Nigeria",
                    "Norway",
                    "Oman",
                    "Pakistan",
                    "Palau",
                    "Panama",
                    "Papua New Guinea",
                    "Paraguay",
                    "Peru",
                    "Philippines",
                    "Poland",
                    "Portugal",
                    "Qatar",
                    "Romania",
                    "Russia",
                    "Rwanda",
                    "Saint Kitts and Nevis",
                    "Saint Lucia",
                    "Saint Vincent",
                    "Samoa",
                    "San Marino",
                    "Sao Tome and Principe",
                    "Saudi Arabia",
                    "Senegal",
                    "Serbia and Montenegro",
                    "Seychelles",
                    "Sierra Leone",
                    "Singapore",
                    "Slovakia",
                    "Slovenia",
                    "Solomon Islands",
                    "Somalia",
                    "South Africa",
                    "Spain",
                    "Sri Lanka",
                    "Sudan",
                    "Suriname",
                    "Swaziland",
                    "Sweden",
                    "Switzerland",
                    "Syria",
                    "Taiwan",
                    "Tajikistan",
                    "Tanzania",
                    "Thailand",
                    "Togo",
                    "Tonga",
                    "Trinidad and Tobago",
                    "Tunisia",
                    "Turkey",
                    "Turkmenistan",
                    "Tuvalu",
                    "Uganda",
                    "Ukraine",
                    "United Arab Emirates",
                    "United Kingdom",
                    "United States",
                    "Uruguay",
                    "Uzbekistan",
                    "Vanuatu",
                    "Vatican City",
                    "Venezuela",
                    "Vietnam",
                    "Yemen",
                    "Zambia",
                    "Zimbabwe"
                );
                ?>
                <select class="form-control" id="country" name="country">
                    <?php foreach ($country_list as $key => $value): ?>
                        <option value="<?php echo $value ?>" <?php echo ($value == $country) ? 'selected' : '' ?>><?php echo $value ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="department" class="col-lg-4 control-label">Department</label>
            <div class="col-lg-8">
                <select id="dept"  class="form-control" name="dept">
                    <option value="">Select Department</option>
                    <option value="CSE" <?php if ($dept == 'CSE') echo ' selected'; ?>>CSE</option>
                    <option value="EEE" <?php if ($dept == 'EEE') echo ' selected'; ?>>EEE</option>
                    <option value="BBA" <?php if ($dept == 'BBA') echo ' selected'; ?>>BBA</option>
                    <option value="Textile" <?php if ($dept == 'Textile') echo ' selected'; ?>>Textile</option>
                    <option value="Pharmacy" <?php if ($dept == 'Pharmacy') echo ' selected'; ?>>Pharmacy</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="potrait" class="col-lg-4 control-label">Photo</label>
            <div class="col-lg-8">
                <label for="photo">File input</label>
                <input type="file" id="photo" name="photo">
                <img src="../upload/<?php echo $row['photo']; ?>" />
            </div>
        </div>

        <hr />


        <div class="form-group">

            <div class="col-lg-offset-2 col-lg-10">
                <button type="submit" id="sub" name="sub" class="btn btn-danger" value="Validate!">Submit</button>
                <button type="reset" id="res" name="res" class="btn btn-info" value="Validate!">Reset</button>
            </div>
        </div>

        
    </form>

</div>
<?php include 'common/footer.php'; ?>