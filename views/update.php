<?php if( isset($contact) ) : ?>

    <?php
        $back_page = (Session::get('page') != null) ? Session::get('page') : 1;
        $back_link = '<a class="back-link" href="'.BASE_URL.'contacts?page='.$back_page.'">';
            $back_link .= '&xlarr; Natrag';
        $back_link .= '</a>';

    ?>

    <div class="contacts">

        <?php echo $back_link; ?>

        <a class="back-link" href="<?php echo BASE_URL.'contacts'.DS.'delete'.DS.$contact->ID; ?>" 
            onclick="return confirm('Izbrisati <?php echo $contact->ime; ?>.\nJeste li sigurni?')">
            Briši
        </a>

        <?php if(Session::get('errorMsg') != null):  ?>
            <div class="message failure position-relative">
                <?php echo "<p>".Session::get('errorMsg')."</p>"; ?>
                <span class="close">Close</span>
                <!-- DELETE SESSION MESSAGE AFTER DISPLAYING IT -->
                <?php unset($_SESSION['errorMsg']); ?>
            </div>
        <?php endif; ?>

        <form id="edit-contact" action="<?php echo BASE_URL.'contacts/update/'.$contact->ID; ?>" method="post" enctype="multipart/form-data">

            <table class="main-table">
                <tr>
                    <td class="bold">Ime:</td>
                    <td><input type="text" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $contact->ime; ?>" /></td>
                </tr>

                <tr>
                    <td class="bold">Prezime:</td>
                    <td><input type="text" name="last_name" value="<?php echo isset($_POST['last_name']) ? $_POST['last_name'] : $contact->prezime; ?>" /></td>
                </tr>

                <tr>
                    <td class="bold">Mobitel 1:</td>
                    <td><input type="text" name="mob1" value="<?php echo isset($_POST['mob1']) ? $_POST['mob1'] : $contact->mob1; ?>" /></td>
                </tr>

                <tr>
                    <td class="bold">Mobitel 2:</td>
                    <td><input type="text" name="mob2" value="<?php echo isset($_POST['mob2']) ? $_POST['mob2'] : $contact->mob2; ?>" /></td>
                </tr>

                <tr>
                    <td class="bold">Kućni:</td>
                    <td><input type="text" name="home_tel" value="<?php echo isset($_POST['home_tel']) ? $_POST['home_tel'] : $contact->kucni; ?>" /></td>
                </tr>

                <tr>
                    <td class="bold">Posao:</td>
                    <td><input type="text" name="job_tel" value="<?php echo isset($_POST['job_tel']) ? $_POST['job_tel'] : $contact->posao; ?>" /></td>
                </tr>

                <tr>
                    <td class="bold">Grad:</td>
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
                    <td class="bold">Opis:</td>
                    <td>
                        <textarea name="desc_contact">
                            <?php echo isset($_POST['desc_contact']) ? $_POST['desc_contact'] : $contact->opis; ?>
                        </textarea>
                    </td>
                </tr>

                <tr>
                    <td>Slika:</td>
                    <td>
                        <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                        <input type="file" name="contact_pic" />
                        <img id="view-contact-pic" alt="Contact picture" src="<?php echo BASE_URL.IMAGES.'contacts'.DS.$contact->slika; ?>" />
                    </td>
                </tr>

            </table>

            <?php echo $back_link; ?>
            <input class="back-link" type="submit" name="submit" value="Spremi promjene" />
            <input class="back-link" type="submit" name="cancel_edit" value="Poništi" />
        </form>

    </div><!--end Contacts-->
<?php endif; ?>