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
                </tr>
                <?php
                global $wpdb;
                $tablename = $wpdb->prefix . "dataslab";
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