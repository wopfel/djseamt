<?php

function mysql_establish() {

    global $config;

    if ( ! mysql_connect( $config['mysql_db_host'], $config['mysql_db_user'], $config['mysql_db_passwd'] ) ) return false;
    if ( ! mysql_select_db( $config['mysql_db_name'] ) ) return false;

    return true;

}

?>
