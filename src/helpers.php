<?php

function alert($message, $title = 'Alert')
{
    return \wxMessageBox($message, $title, wxOK|wxICON_INFORMATION);
}

function error($message, $title = 'Error')
{
    return \wxMessageBox($message, $title, wxOK|wxICON_ERROR);
}

function confirm($message, $title = 'Confirm')
{
    $answer = \wxMessageBox($message, $title, wxYES_NO);

    return $answer === wxYES;
}