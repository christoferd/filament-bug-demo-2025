<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;

    protected $table = 'customer';

    protected $fillable = [
        'status_id',
        'first_name',
        'last_name',
        'shipping_addresses', // JSON,
    ];

    protected $casts = [
        'shipping_addresses' => 'array', // Stored as JSON
    ];

    /**
     * Assigns an account manager to the current model instance.
     *
     * @param User $user The user to be assigned as the account manager.
     * @param bool $save Whether to save the changes to the database immediately (default: true).
     *
     * @return void
     */
    public function assignAccountManager(User $user, bool $save = true): void
    {
        $this->account_manager_user_id = $user->id;
        if($save)
        {
            $this->save();
        }
    }

    /**
     * Return the full name of the customer.
     *
     * @return string
     */
    public function fullName(): string
    {
        return trim(($this->first_name ?? '').' '.($this->last_name ?? ''));
    }

}
