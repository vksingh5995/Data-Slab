<?php

global $wpdb;
$tablename = $wpdb->prefix . "dataslab";

// Delete record
if (isset($_GET['delete'])) {
    $delete = $_GET['delete'];
    $wpdb->query("DELETE FROM " . $tablename . " WHERE id=" . $delete);
}

// Update record
if (isset($_GET['subpage']) and  $_GET['subpage'] == 'update') {
    include( __DIR__ . '/updatelist.php');
}
else{
?>
    <div class="dataslab-container">
        <h1>All Entries</h1>

        <div class="table-cls">
            <table class="tab" width='100%' border='2'>
                <tr>
                    <th>S.no</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone No</th>
                    <th id="act">Action</th>
                    <th id="act1"></th>
                </tr>
                <?php
                // Select records
                $entriesList = $wpdb->get_results("SELECT * FROM " . $tablename . " order by id asc");
                if (count($entriesList) > 0) {
                    $count = 1;
                    foreach ($entriesList as $entry) {
                        $id = $entry->id;
                        $name = $entry->name;
                        $uname = $entry->username;
                        $email = $entry->email;
                        $phone = (isset($entry->phone)) ? $entry->phone : "";

                        echo "<tr>
                                <td>" . $count . "</td>
                                <td>" . $name . "</td>
                                <td>" . $uname . "</td>
                                <td>" . $email . "</td>
                                <td>" . $phone . "</td>
                                <td> <a  href='?page=allentries&delete=" . $id . "'>Delete</a></td>
                                <td> <a  href='?page=allentries&subpage=update&updateId=" . $id . "'>Update</a></td>
                            </tr>";
                        $count++;
                    }
                } else {
                    echo "<tr><td colspan='8'>No record found</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
<?php } ?>