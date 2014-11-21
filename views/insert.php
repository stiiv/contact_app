<?php if( isset($succ_or_err) ): ?>
    <div class="message <?php echo isset($succ_or_err) ? $succ_or_err: null; ?> position-relative">
        <?php echo isset($errorMsg) ? "<p>{$errorMsg}</p>" : null; ?>
        <span class="close">Close</span>
    </div>
<?php endif;?>
<form id="insert-new-contact" action="<?php echo BASE_URL.'contacts/save'?>" method="post" enctype="multipart/form-data">
    <fieldset>
    <legend><?php echo isset($form_title) ? $form_title : null; ?></legend>
    <table>
        <tr>
            <td>Ime:</td>
            <td><input type="text" name="name" value="<?php echo $this->var_check($_POST['name']); ?>" /></td>
        </tr>

        <tr>
            <td>Prezime:</td>
            <td><input type="text" name="last_name" value="<?php echo $this->var_check($_POST['last_name']); ?>" /></td>
        </tr>

        <tr>
            <td>Grad:</td>
            <td>
                <select name="city">
                    <option value="0">Odaberite:</option>
            <?php

            if(isset($cities)) {
                foreach($cities as $city) {
                    $selected = ( isset($_POST['city']) && $_POST['city'] == $city->id )
                        ? 'selected="selected"' : '';
                    echo
                    '<option '.$selected.' value="'.$city->id.'">'.$city->ime.'</option>';
                }
            }

            ?>
                </select>
            </td>
        </tr>

        <tr>
            <td>Mobitel 1:</td>
            <td><input type="text" name="mob1" value="<?php echo $this->var_check($_POST['mob1']); ?>" /></td>
        </tr>

        <tr>
            <td>Mobitel 2:</td>
            <td><input type="text" name="mob2" value="<?php echo $this->var_check($_POST['mob2']); ?>" /></td>
        </tr>

        <tr>
            <td>Kućni:</td>
            <td><input type="text" name="home_tel" value="<?php echo $this->var_check($_POST['home_tel']); ?>" /></td>
        </tr>

        <tr>
            <td>Posao:</td>
            <td><input type="text" name="job_tel" value="<?php echo $this->var_check($_POST['job_tel']); ?>" /></td>
        </tr>

        <tr>
            <td></td>
            <td><input type="hidden" name="MAX_FILE_SIZE" value="1048576" /></td>
        </tr>

        <tr>
            <td>Slika:</td>
            <td><input type="file" name="contact_pic" /></td>
        </tr>

        <tr>
            <td>Opis:</td>
            <td><textarea name="desc_contact"><?php echo $this->var_check($_POST['desc_contact']); ?></textarea></td>
        </tr>

        <tr>
            <td></td>
            <td><input type="submit" value="Spremi" /></td>
        </tr>
    </table>
    </fieldset>
</form>