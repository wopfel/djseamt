<?php

# Some basic checking
if ( ! preg_match( '/^[[:xdigit:]]{8}-[[:xdigit:]]{4}-[[:xdigit:]]{4}-[[:xdigit:]]{4}-[[:xdigit:]]{12}$/', $_POST["id"] ) ) {
    # TODO
    print "ERROR";
    print "UUID format mismatch.";
    exit;
}

# Only lowercase characters are allowed
if ( preg_match( '/[[:upper:]]/', $_POST["id"] ) ) {
    # TODO
    print "ERROR";
    print "UUID case mismatch.";
    exit;
}

# Hostname check
if ( ! preg_match( '/^[[:alnum:]-]+$/', $_POST["hostname"] ) ) {
    # TODO
    print "ERROR";
    print "Hostname format mismatch.";
    exit;
}

# Version string check
if ( ! preg_match( '/^[[:digit:]]+\.[[:digit:]]+\.[[:digit:]]+\.[[:digit:]]+$/', $_POST["client_version"] ) ) {
    # TODO
    print "ERROR";
    print "Client version format mismatch.";
    exit;
}

# Only POST accepted
if ( $_SERVER['REQUEST_METHOD'] != "POST" ) {
    # TODO
    print "ERROR";
    print "Request method mismatch.";
    exit;
}


require( "config.php" );
require( "mysql.php" );

if ( ! mysql_establish() ) {
    # TODO
    print "ERROR";
    print mysql_error();
}

$query = sprintf( "SELECT * FROM client_list WHERE uuid='%s'",
                            mysql_real_escape_string( $_POST["id"] )
                );

$result = mysql_query( $query );

if ( ! $result ) {
    # TODO 
    print "ERROR";
    print mysql_error();
}   

$info = "";


if ( mysql_num_rows( $result ) < 1 ) {
    # Add new entry
    $query = sprintf( "INSERT INTO client_list (uuid,first_contact) VALUES ('%s',CURRENT_TIMESTAMP)",
                                   mysql_real_escape_string( $_POST["id"] )
                    );
    if ( ! mysql_query( $query ) ) {
        # TODO
        print "ERROR";
        print mysql_error();
    }
    $info .= "<newentry />";
}


# Update existing entry
$query = sprintf( "UPDATE client_list SET recent_contact=CURRENT_TIMESTAMP, recent_hostname='%s', recent_version='%s', recent_ipaddr='%s' WHERE uuid='%s' LIMIT 1",
                               mysql_real_escape_string( $_POST["hostname"] ),
                               mysql_real_escape_string( $_POST["client_version"] ),
                               mysql_real_escape_string( $_SERVER["REMOTE_ADDR"] ),
                               mysql_real_escape_string( $_POST["id"] )
                );
if ( ! mysql_query( $query ) ) {
    # TODO
    print "ERROR";
    print mysql_error();
}

$info .= "<updatedentry />";


print "OK.\n";
print "Your uuid: " . $_POST["id"] . "\n";
# TODO: Define and use a default message protocol
print "$info\n";
print_r( $_POST );

?>
