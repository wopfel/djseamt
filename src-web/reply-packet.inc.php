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

class ReplyPacket {

    var $status = "UNKNOWN";
    var $message_text;
    var $infos = array();

    function setStatus( $newStatus ) {
        $this->status = $newStatus;
    }

    function setMessageText( $newMsg ) {
        $this->message_text = $newMsg;
    }

    function setInfo( $newInfoIndex, $newInfoValue ) {
        $this->infos[ $newInfoIndex ] = $newInfoValue;
    }

    function getXmlString() {
        $str = array();
        $str[] = "<reply>";
        # TODO: Encode to Xml standard
        $str[] = "<status>$this->status</status>";
        # TODO: Encode to Xml standard
        $str[] = "<message>$this->message_text</message>";
        $str[] = "<sender typ='djseamt-server' version='0.0.0.1' />";  # TODO: version string should be a global variable
        $str[] = "<infos>";
        foreach ( $this->infos as $info_idx => $info_val ) {
            $str[] = "<$info_idx>$info_val</$info_idx>"; # TODO: Encode to Xml standard
        }
        $str[] = "</infos>";
        $str[] = "</reply>";
        $str[] = "";  # So we get a newline char at the end

        return join( "\n", $str );
    }

}

?>
