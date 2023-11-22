<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class PasswordReset extends Authenticatable
{
    protected $table = "password_reset_tokens";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'token',
        'created_at'
    ];

    public $timestamps = false;
}
