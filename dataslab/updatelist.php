<?php

global $wpdb;
$tablename = $wpdb->prefix . "dataslab";

// Update record
if (isset($_GET['updateId'])) {
    $updateId = $_GET['updateId'];
    $query = "SELECT * FROM " . $tablename . " WHERE id=" . $updateId;
    $updateData = $wpdb->get_row( $query );

    // echo json_encode( $updateData ); die;
?>

<div class="dataslab-update-container">
    <div class="page-container">
        <h1>Update Entry</h1>
        <div class="row-form-tab">
            <form class="form-tab" id="dataslab-update-user-form" onsubmit="return false">
            <input type="hidden" name="updateId" value="<?php echo $updateData->id; ?>">
                <table>

                    <tr class="table">
                        <td class="name">Name</td>
                        <td><input type="text" name="name" value="<?php echo $updateData->name; ?>" maxlength="18" pattern='[a-zA-Z\s]*' placeholder="Brock Lesnar" required></td>
                    </tr>

                    <tr class="table">
                        <td class="name">Username</td>
                        <td><input type='text' name='username' value="<?php echo $updateData->username; ?>" pattern='[a-z0-9]+_[a-z0-9]{2,}$' placeholder="brock_lesnar" required></td>
                    </tr>
                    <tr class="table">
                        <td class="name">Email</td>
                        <td><input type='text' name='email' value="<?php echo $updateData->email; ?>" pattern='[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$' placeholder="brock@abc.xyz" required></td>
                    </tr>
                    <tr class="table">
                        <td class="name">Phone No</td>
                        <td><input type='tel' name='phone' value="<?php echo $updateData->phone; ?>" pattern='[+0-9]{3}-[0-9]{3}-[0-9]{3}-[0-9]{4}' placeholder="+00-123-456-7890" required></td>
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
<?php
}
?>