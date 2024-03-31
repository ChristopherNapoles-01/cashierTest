<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Cashier\Billable;

class AccountModel extends Model
{
    use HasFactory, Billable;

    protected $table = 'account';

    protected $primaryKey = 'account_id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'account_id',
        'account_name',
        'stripe_id',
        'pm_type',
        'pm_last_four',
        'created_at',
        'updated_at'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if(!isset($this->attributes['account_id'])) {
            $this->attributes['account_id'] = Str::random(30);
        }
   
    }

    public function subscriptions() : HasMany
    {
        return $this->hasMany(SubscriptionsModel::class, 'account_id');
    }

    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = strtotime($value);
    }

    public function setUpdatedAtAttribute($value)
    {        
        $this->attributes['updated_at'] = strtotime($value);
    }
}
