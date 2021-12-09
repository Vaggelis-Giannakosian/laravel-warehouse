<?php

if (!function_exists('flash')) {

    function flash(string $message, string $status = 'success', string $group = 'top-left')
    {
        session()->flash('flash', [
            'message' => $message,
            'status' => $status,
            'group' => $group,
        ]);
    }
}
