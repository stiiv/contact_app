<?php if( isset($contact) ) : ?>

    <?php
        $back_page = (Session::get('page') != null) ? Session::get('page') : 1;
        $back_link = '<a class="back-link" href="'.BASE_URL.'contacts?page='.$back_page.'">';
            $back_link .= '&xlarr; Natrag';
        $back_link .= '</a>';

    ?>

    <div class="contacts">
        <!-- MESSAGE DIV -->
        <?php if( Session::get("action_message") != null ):  ?>
        <div class="message edit-message <?php echo ( Session::get("succ_or_err") != null ) ? Session::get("succ_or_err") : "" ; ?> position-relative">
            <?php echo "<p>".Session::get("action_message")."</p>"; ?>
            <span class="close">Close</span>
        </div>
        <?php unset($_SESSION['action_message'], $_SESSION['succ_or_err']); ?>

        <?php endif; ?>
        <?php echo $back_link; ?>

        <a class="back-link" href="<?php echo BASE_URL.'contacts'.DS.'edit'.DS.$contact->ID; ?>">
            Uredi
        </a>

        <a class="back-link" href="<?php echo BASE_URL.'contacts'.DS.'delete'.DS.$contact->ID; ?>" 
            onclick="return confirm('Izbrisati <?php echo $contact->ime; ?>.\nJeste li sigurni?')">
            Briši
        </a>

        <table class="main-table">
            <tr>
                <td class="bold">Ime:</td>
                <td><?php echo $contact->ime; ?></td>
            </tr>

            <tr>
                <td class="bold">Prezime:</td>
                <td><?php echo $contact->prezime; ?></td>
            </tr>

            <tr>
                <td class="bold">Mobitel 1:</td>
                <td><?php echo $contact->mob1; ?></td>
            </tr>

            <tr>
                <td class="bold">Mobitel 2:</td>
                <td><?php echo $contact->mob2; ?></td>
            </tr>

            <tr>
                <td class="bold">Kućni:</td>
                <td><?php echo $contact->kucni; ?></td>
            </tr>

            <tr>
                <td class="bold">Posao:</td>
                <td><?php echo $contact->posao; ?></td>
            </tr>

            <tr>
                <td class="bold">Grad:</td>
                <td><?php echo $contact->ime_grada; ?></td>
            </tr>

            <tr>
                <td class="bold">Opis:</td>
                <td><?php echo $contact->opis; ?></td>
            </tr>

            <tr>
                <td>Slika:</td>
                <td>
                    <img id="view-contact-pic" alt="Contact picture" src="<?php echo BASE_URL.IMAGES.'contacts'.DS.$contact->slika; ?>" />
                </td>
            </tr>
        </table>

        <?php echo $back_link; ?>
    </div>
<?php endif; ?>