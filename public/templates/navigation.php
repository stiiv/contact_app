<?php if( isset($_SESSION['id_user']) ) : ?>
	<ul>
	    <li><a href="<?php echo BASE_URL.'contacts'; ?>">Contacts</a></li>
	    <li>
	    	<a href="<?php echo BASE_URL.'contacts'.DS.'insert'; ?>">
	    		Unesi novi kontakt
	    	</a>
	    </li>
	    <!--USERNAME-->
	    <li id="username-menu">
	    	<a href="<?php echo "#"; ?>">
	    		User: <?php echo $this->var_check($username); ?> &dtrif;
	    	</a>
	    	<ul>
	    		<li>
	    			<a href="<?php echo BASE_URL.'contacts'.DS."logout"; ?>">
	    				Log out
	    			</a>
	    		</li>
	    	</ul>
	    </li><!--END USERNAME-->
	</ul>
<!-- SEARCH FORM -->
	<aside>
		<form action="<?php echo BASE_URL; ?>contacts/search" method="post">
	        <input id="search" type="text" name="search" />
	        <input id="search-btn" type="submit" value="Traži" />
	    </form>
	</aside>
<?php else: ?>
	<form id="login-form" action="<?php echo BASE_URL; ?>main/login" method="POST">
		<label for="username">Username</label>
		<input id="username" type="text" name="username" autofocus="autofocus" />

		<label for="password">Password</label>
		<input id="password" type="password" name="password" />

		<input type="submit" value="Log in" />
	</form>
<?php endif; ?>
