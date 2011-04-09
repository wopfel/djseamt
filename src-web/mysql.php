<?php


##############################################################################
#  
#    Copyright (C) 2011  Bernd Arnold - https://github.com/wopfel
#  
#    This file is part of DJSEAMT.
#    https://github.com/wopfel/djseamt
# 
#    This program is free software; you can redistribute it and/or modify
#    it under the terms of the GNU General Public License version 2 as 
#    published by the Free Software Foundation.
#
#    This program is distributed in the hope that it will be useful,
#    but WITHOUT ANY WARRANTY; without even the implied warranty of
#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#    GNU General Public License for more details.
#
#    You should have received a copy of the GNU General Public License along
#    with this program; if not, write to the Free Software Foundation, Inc.,
#    51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
#
##############################################################################


function mysql_establish() {

    global $config;

    if ( ! mysql_connect( $config['mysql_db_host'], $config['mysql_db_user'], $config['mysql_db_passwd'] ) ) return false;
    if ( ! mysql_select_db( $config['mysql_db_name'] ) ) return false;

    return true;

}

?>
