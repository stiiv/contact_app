<?php if( isset($succ_or_err) ): ?>
    <div class="message <?php echo $this->var_check($succ_or_err); ?> position-relative">
        <?php echo isset($errorMsg) ? "<p>{$errorMsg}</p>" : null; ?>
        <span class="close">Close</span>
    </div>
<?php endif;?>
<form id="insert-new-contact" action="<?php echo BASE_URL; ?>main/register" method="post">
    <fieldset>
    <legend><?php echo $this->var_check($sign_up); ?></legend>
    <table>
        <tr>
            <td>Username:</td>
            <td><input type="text" name="username" value="<?php echo $this->var_check($_POST['username']) ?>" /></td>
        </tr>

        <tr>
            <td>Password:</td>
            <td><input type="password" name="password" value="<?php echo $this->var_check($_POST['password']) ?>" /></td>
        </tr>

        <tr>
            <td>Retype Password:</td>
            <td><input type="password" name="password_again" value="<?php echo $this->var_check($_POST['password_again']) ?>" /></td>
        </tr>

        <tr>
            <td>Ime:</td>
            <td><input type="text" name="first_name" value="<?php echo $this->var_check($_POST['first_name']) ?>" /></td>
        </tr>

        <tr>
            <td>Prezime:</td>
            <td><input type="text" name="last_name" value="<?php echo $this->var_check($_POST['last_name']) ?>" /></td>
        </tr>

        <tr>
            <td>E-mail:</td>
            <td><input type="email" name="email" value="<?php echo $this->var_check($_POST['email']) ?>" /></td>
        </tr>

        <tr>
            <td></td>
            <td><input type="submit" value="<?php echo $this->var_check($sign_up); ?>" /></td>
        </tr>
    </table>
    </fieldset>
</form>