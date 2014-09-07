<?php

if ( ! function_exists('alert')) {
    function alert($message, $title = 'Alert')
    {
        return \wxMessageBox($message, $title, wxOK|wxICON_INFORMATION);
    }
}

if ( ! function_exists('error')) {
    function error($message, $title = 'Error')
    {
        return \wxMessageBox($message, $title, wxOK|wxICON_ERROR);
    }
}

if ( ! function_exists('confirm')) {
    function confirm($message, $title = 'Confirm')
    {
        $answer = \wxMessageBox($message, $title, wxYES_NO);

        return $answer === wxYES;
    }
}