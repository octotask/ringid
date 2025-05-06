<div class="form_content">
    <h3><?=$page_title?></h3>
    <form id="valid_user" action='<?=site_url($action)?>' method='post'>
        <table cellspacing='1' cellpadding='2' width='100%' class='pad_10'>
            <tr>
                <th>User Name <span class='req_mark'>*</span></th>
                <td><input type='text' name='user_name' value='<?=$user_name?>'  class="text ui-widget-content ui-corner-all width_200" /></td>
            </tr>
            <tr>
                <th>Password <span class='req_mark'>*</span></th>
                <td><input type='password' name='password' value='<?=$password?>' id="password" class="text ui-widget-content ui-corner-all width_200" /></td>
            </tr>
            <tr>
                <th>Confirm Password <span class='req_mark'>*</span></th>
                <td><input type='password' name='confirm_password' value='<?=$password?>'class="text ui-widget-content ui-corner-all width_200" /></td>
            </tr>
            <tr>
                <th>Email </th>
                <td><input type='text' name='email' value='<?=$email?>'class="text ui-widget-content ui-corner-all width_200" /></td>
            </tr>
            <tr>
                <th>First Name <span class='req_mark'>*</span></th>
                <td><input type='text' name='first_name' value='<?=$first_name?>'class="text ui-widget-content ui-corner-all width_200" /></td>
            </tr>
            <tr>
                <th>Last Name <span class='req_mark'>*</span></th>
                <td><input type='text' name='last_name' value='<?=$last_name?>'class="text ui-widget-content ui-corner-all width_200" /></td>
            </tr>
            <tr>
                <th>Address <span class='req_mark'>*</span></th>
                <td><textarea name='address' rows='5' cols='40'><?=$address?></textarea></td>
            </tr>
            <tr>
                <th>Permission <span class='req_mark'>*</span></th>
                <td>
                    <label class='block'><input type='checkbox' name='permission[]' value='1' <?php
                        if (common::view_permit($permission)) {
                            echo'checked';
                        }?>/> Only View</label>
                    <label class='block'><input type='checkbox' name='permission[]' value='2' <?php
                        if (common::add_permit($permission)) {
                            echo'checked';
                        }
?>/> Add New</label>
                    <label class='block'><input type='checkbox' name='permission[]' value='4' <?php
                        if (common::update_permit($permission)) {
                            echo'checked';
                        }
?>/> Edit/Update</label>
                </td>
            </tr>
            <tr><th>&nbsp;</th>
                <td>
                    <input type='submit' name='save' value='Save' class='button' />
                    <input type='button' name='cancel' value='Cancel' class='button cancel' />
                </td></tr>
        </table>
    </form>
</div>