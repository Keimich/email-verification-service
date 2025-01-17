<?php

namespace App\Models;

class ValidationUsers
{
    const RULE_USERS = [
        'name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email',
        'password' => 'nullable|string|max:255'
    ];

    const RULE_LEADS = [
        'name' => 'nullable|string|max:255',
        'last_name' => 'nullable|string|max:255',
        'email' => 'required|email',
        'password' => 'nullable|string|max:255'
    ];
}
