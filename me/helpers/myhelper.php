<?php

function indent($level) {
    $ret = '';
    for ($i = 0; $i < $level; $i++) {        
        $ret .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    }
    return $ret;
}