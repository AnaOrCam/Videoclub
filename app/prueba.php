<?php
$contrasena=password_hash('amoc',PASSWORD_DEFAULT);
$verify=password_verify('amoc', '$2y$10$O8Yqxank.sGq6b36DscTk.vuL7fhrliQUoeNUFION3.zc30nEh/J2');
echo $contrasena;
echo $verify;

