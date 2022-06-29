<?php

require('_header.php');

$announcements = Config::get('announcements', 'announcements');

?>

<div class="container">
	<h1>Error 404</h1>
	<p>The page you requested could not be found!</p>
</div>

<?php

require('_footer.php');