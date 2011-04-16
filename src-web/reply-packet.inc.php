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


# A class handling the reply to the client
# Usage: create an instance, set data and send return value of getXmlString() to client

class ReplyPacket {

    var $status = "UNKNOWN";
    var $module = "UNKNOWN";
    var $message_text;
    var $infos = array();

    /**
      * Set the status of this reply packet
      */
    function setStatus( $newStatus ) {
        $this->status = $newStatus;
    }

    /**
      * Set the module name (origin) of this reply packet
      */
    function setModule( $newModule ) {
        $this->module = $newModule;
    }

    /**
      * Set the message text of this reply packet
      */
    function setMessageText( $newMsg ) {
        $this->message_text = $newMsg;
    }

    /**
      * Set informational data of this reply packet
      *
      * Every index=value item is generated as <infos><index>value</index>...</infos>
      */
    function setInfo( $newInfoIndex, $newInfoValue ) {
        $this->infos[ $newInfoIndex ] = $newInfoValue;
    }

    /**
      * Get the XML string of this reply packet
      *
      * The string can then be passed to the client
      */
    function getXmlString() {
        $str = array();
        $str[] = "<reply>";
        $str[] = "<protocol version='0' />";  # TODO: should be at least 1, and it should be a global variable, and it should be checked by the client
        # TODO: Encode to Xml standard
        $str[] = "<status>$this->status</status>";
        # TODO: Encode to Xml standard
        $str[] = "<message>$this->message_text</message>";
        $str[] = "<sender name='djseamt-server' version='0.0.0.1' current_timestamp='".time()."' module='$this->module' />";  # TODO: version string should be a global variable
        if ( count( $this->infos ) > 0 ) {
            $str[] = "<infos>";
            foreach ( $this->infos as $info_idx => $info_val ) {
                $str[] = "<$info_idx>$info_val</$info_idx>"; # TODO: Encode to Xml standard
            }
            $str[] = "</infos>";
        }
        $str[] = "</reply>";
        $str[] = "";  # So we get a newline char at the end

        return join( "\n", $str );
    }

}

?>
