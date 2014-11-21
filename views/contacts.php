<div class="contacts">
<p><?php if(isset($results_num)) echo $results_num; ?>: <?php echo isset($contact_num) ? $contact_num : 0; ?></p>
<?php if( isset($no_contacts) ) echo "<h2>{$no_contacts}</h2>"; ?>

<?php //$action_ ?>
<?php if( isset($action_message) ) : ?>

    <div class="position-relative <?php echo $this->var_check($succ_or_err);?>" style="padding: 1%;">
        <?php echo "<p>{$action_message}</p>"; ?>
        <span class="close">Close</span>
    </div>

<?php endif; ?>

<?php if( isset($contacts) ): ?>
    <table class="main-table">
        <tr>
            <th>Ime</th>
            <th>Prezime</th>
            <th>Mobitel 1</th>
            <th>Mobitel 2</th>
            <th>Kućni</th>
            <th>Posao</th>
            <th>Action</th>
        </tr>
    <?php foreach($contacts as $contact): ?>

        <tr>
            <td>
                <a class="view-contact" href="<?php echo BASE_URL.'contacts'.DS.'view'.DS.$contact->ID; ?>">
                    <?php Session::set('page', $this->var_check($_GET['page'])); ?>
                    <?php echo $contact->ime; ?>
                </a>
            </td>
            <td><?php echo $contact->prezime; ?></td>
            <td><?php echo $contact->mob1; ?></td>
            <td><?php echo $contact->mob2; ?></td>
            <td><?php echo $contact->kucni; ?></td>
            <td><?php echo $contact->posao; ?></td>
            <td>
                <a class="view-contact" href="<?php echo BASE_URL.'contacts'.DS.'edit'.DS.$contact->ID; ?>">
                    Uredi
                </a>
                <a class="view-contact" href="<?php echo BASE_URL.'contacts'.DS.'delete'.DS.$contact->ID; ?>" 
                    onclick="return confirm('Izbrisati <?php echo $contact->ime; ?>.\nJeste li sigurni?')">
                    Briši
                </a>
            </td>
        </tr>

    <?php endforeach; ?>
    </table>
<?php endif; ?>
</div>

<?php if( isset($pagination) ): ?>
    <div class="pagination">
        <?php echo $pagination; ?>
    </div>
<?php endif; ?>