<?php
session_unset();
session_destroy();
header('Location: Index.php');
