<?php

global $wpdb;

// Add record
if (isset($_POST['but_submit'])) {

    $name = $_POST['txt_name'];
    $uname = $_POST['txt_uname'];
    $email = $_POST['txt_email'];
    $phone = $_POST['txt_phone'];
    $tablename = $wpdb->prefix . "dataslab";

    if ($name != '' && $uname != '' && $email != '' && $phone != '') {
        $check_data = $wpdb->get_results("SELECT * FROM " . $tablename . " WHERE username='" . $uname . "' ");
        if (count($check_data) == 0) {
            $insert_sql = "INSERT INTO " . $tablename . "(name,username,email,phone) values('" . $name . "','" . $uname . "','" . $email . "','" . $phone . "') ";
            $wpdb->query($insert_sql);
            echo "<p>Save Successfully.</p>";
        }
    }
}


?>
<html>

<head>
    <link rel="stylesheet" href="#">
    <style type="text/css">
        body {
            background: url(https://cdn.pixabay.com/photo/2017/02/14/03/03/ama-dablam-2064522_960_720.jpg);
            background-size: cover;
            font-family: sans-serif;
            background-repeat: no-repeat;
            height: 100%;
        }

        .page-container {
            width: 800px;
            margin-top: 110px;
            margin-left: 200px;
            background-color: rgb(0, 0, 0, 0.6);
            color: #ffffff;
            text-align: center;
            border-radius: 10px;
        }

        h1 {
            padding-bottom: 30px;
            padding-top: 30px;
            background-color: rgb(0, 0, 0, 0.5);
            color: #ffffff;
            left: 0;
            right: 0;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            justify-content: center;
        }

        .form-tab {
            width: 800px;
            margin: auto;
            padding-top: 30px;
            padding-bottom: 30px;
            padding-left: 50px;
            line-height: 40px;
            font-size: 16px;
            justify-content: center;
        }

        .name {
            margin-left: 25px;
            margin-top: 30px;
            width: 125px;
            color: white;
            font-size: 18px;
            font-weight: 700;
            text-align: justify;
        }

        .form-tab td input[type=text] {
            display: block;
            position: relative;
            left: 50px;
            line-height: 40px;
            width: 480px;
            border-radius: 6px;
            padding-left: 10px;
            font-size: 16px;
            font-weight: 600;
            background-color: #ffffff;
            color: #1d2327;
            margin: 20px 0 20px 0;
        }

        .form-tab td input[type=tel] {
            display: block;
            position: relative;
            left: 50px;
            line-height: 40px;
            width: 480px;
            border-radius: 6px;
            padding-left: 10px;
            font-size: 16px;
            color: #1d2327;
            font-weight: 600;
            margin: 20px 0 20px 0;
        }

        .form-tab td input[type=submit] {
            background-color: #3baf9f;
            display: block;
            margin: 20px 0px 20px 0px;
            text-align: center;
            border-radius: 12px;
            border: 2px solid #3baf9f;
            padding: 14px 100px;
            outline: none;
            color: white;
            cursor: pointer;
            transition: 0.25px;
            margin-left: 50px;
        }

        .form-tab td input[type=submit]:hover {
            background-color: #5390f5;
            border-color: #5390f5;
        }

        p {
            text-align: center;
            font-weight: 700;
            font-size: 18px;
            color: #ffffff;

        }
    </style>
</head>

<body>
    <div class="row">
        <div class="page-container">
            <h1>Add New Entry</h1>
            <div class="row-form-tab">
                <form class="form-tab" method='post' action=''>
                    <table>

                        <tr class="table">
                            <td class="name">Name</td>
                            <td><input type='text' name='txt_name' value='' maxlength=" 18" pattern='[a-zA-Z]+*\s*[a-zA-Z]' placeholder="Brock Lesnar" required></td>
                        </tr>

                        <tr class="table">
                            <td class="name">Username</td>
                            <td><input type='text' name='txt_uname' value='' pattern='[a-z0-9]+_[a-z0-9]{2,}$' placeholder="brock_lesnar" required></td>
                        </tr>
                        <tr class="table">
                            <td class="name">Email</td>
                            <td><input type='text' name='txt_email' value='' pattern='[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$' placeholder="brock@abc.xyz" required></td>
                        </tr>
                        <tr class="table">
                            <td class="name">Phone No</td>
                            <td><input type='tel' name='txt_phone' value='' pattern='[+0-9]{3}-[0-9]{3}-[0-9]{3}-[0-9]{4}' placeholder="+00-123-456-7890" required></td>
                        </tr>
                        <tr class="table">
                            <td>&nbsp;</td>
                            <td><input type='submit' name='but_submit' value='Submit'></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>

</html>