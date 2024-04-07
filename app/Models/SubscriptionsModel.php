<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Cashier\Subscription;

class SubscriptionsModel extends Subscription
{
    use HasFactory;

    protected $table = 'subscriptions';

    protected $primaryKey = 'subscription_id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'subscription_id',
        'account_id',
        'subscriptions_status',
        'name',
        'type',
        'stripe_id',
        'stripe_status',
        'stripe_price',
        'quantity',
        'trial_ends_at',
        'ends_at',
        'created_at',
        'updated_at'
    ];


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if(!isset($this->attributes['subscription_id'])) {
            $this->attributes['subscription_id'] = Str::random(30);
        }
    }

    public function items() : HasMany
    {
        return $this->hasMany(SubscriptionItemsModel::class, 'subscription_id');
    }

    public function owner() : BelongsTo
    {
        return $this->belongsTo(AccountModel::class, 'account_id');
    }

    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = strtotime($value);
        logger()->info(json_encode([$this->attributes]));
    }

    public function setUpdatedAtAttribute($value)
    {
        $this->attributes['updated_at'] = strtotime($value);
    }

    public function setEndsAtAttribute($value)
    {
        if (isset($this->attributes['ends_at'])) {
            $this->attributes['ends_at'] = strtotime($value);
        }
        
    }

    public function setTrialEndsAtAttribute($value) {
        
        if (isset($this->attributes['trial_ends_at'])) {
            $this->attributes['trial_ends_at'] = strtotime($value);
        }
      
    }
}
