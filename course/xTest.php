<?php

echo 'show directory below:<br>';
echo __DIR__;
echo '<br>';
echo 'show root directory below:<br>';
echo $_SERVER['DOCUMENT_ROOT'];
echo '<br>';
echo 'show parent directory below:<br>';
echo dirname(__DIR__);
