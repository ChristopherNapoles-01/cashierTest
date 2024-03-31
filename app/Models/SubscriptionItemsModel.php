<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Cashier\SubscriptionItem;

class SubscriptionItemsModel extends SubscriptionItem
{
    use HasFactory;

    protected $table = 'subscription_items';
    
    protected $primaryKey = 'subscription_item_id';

    protected $keyType = 'string';

    protected $fillable = [
        'subscription_item_id',
        'subscription_id',
        'stripe_id',
        'stripe_product',
        'stripe_price',
        'quantity',
        'created_at',
        'updated_at'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if (!isset($this->attributes['subscription_item_id']))
        {
            $this->attributes['subscription_item_id'] = Str::random(30);
        }
    }

    public function subscription() : BelongsTo
    {
        return $this->belongsTo(SubscriptionsModel::class, 'subscription_id');
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
