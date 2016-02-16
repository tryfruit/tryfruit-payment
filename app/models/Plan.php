<?php

class Plan extends Eloquent
{
    /* -- Fields -- */
    protected $guarded = array(
    );

    protected $fillable = array(
        'name',
        'description',
        'amount',
        'braintree_plan_id',
        'braintree_merchant_account_id',
        'braintree_merchant_currency',
    );

    /* -- No timestamps -- */
    public $timestamps = false; 

    /* -- Relations -- */
    public function subscriptions() { return $this->hasMany('Subscription'); }
}
