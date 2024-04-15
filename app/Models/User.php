<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'position',
        'address',
        'status',
        'currency',
        'language',
        'config',
        'can_view_user',
        'can_add_user',
        'can_edit_user',
        'can_delete_user',
        'can_view_customer',
        'can_add_customer',
        'can_edit_customer',
        'can_delete_customer',
        'can_view_hotel',
        'can_add_hotel',
        'can_edit_hotel',
        'can_delete_hotel',
        'can_view_expense',
        'can_add_expense',
        'can_edit_expense',
        'can_delete_expense',
        'can_book_hotel',
        'can_book_transportation',
        'can_book_kitchen',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status' => 'boolean',
            'currency' => 'boolean',
            'language' => 'boolean',
            'config' => 'boolean',
            'can_view_user' => 'boolean',
            'can_add_user' => 'boolean',
            'can_edit_user' => 'boolean',
            'can_delete_user' => 'boolean',
            'can_view_customer' => 'boolean',
            'can_add_customer' => 'boolean',
            'can_edit_customer' => 'boolean',
            'can_delete_customer' => 'boolean',
            'can_view_hotel' => 'boolean',
            'can_add_hotel' => 'boolean',
            'can_edit_hotel' => 'boolean',
            'can_delete_hotel' => 'boolean',
            'can_view_expense' => 'boolean',
            'can_add_expense' => 'boolean',
            'can_edit_expense' => 'boolean',
            'can_delete_expense' => 'boolean',
            'can_book_hotel' => 'boolean',
            'can_book_transportation' => 'boolean',
            'can_book_kitchen' => 'boolean',

        ];
    }
}
