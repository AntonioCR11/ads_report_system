<?php

use Illuminate\Support\Facades\Auth;

function loggedIn()
{
    if (Auth::guard("web")->check()) {
        return true;
    }
    return false;
}
function activeUser()
{
    if (!loggedIn()) {
        return false;
    }
    return Auth::guard("web")->user();
}
