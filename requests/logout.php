<?php

setcookie('user_auth', '', time() + (10 * 365 * 24 *60 * 60), '/');
setcookie('user_status', '', time() + (10 * 365 * 24 *60 * 60), '/');

?>