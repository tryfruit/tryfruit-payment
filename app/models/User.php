<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\Reminders\RemindableTrait;

class User extends Eloquent implements UserInterface, RemindableInterface
{
    /* UserTrait implements the functions from UserInterface */
    use UserTrait;

    /* RemindableTrait implements the functions from RemindableInterface */
    use RemindableTrait;

    /* -- Fields -- */
    protected $guarded = array(
        'remember_token',
    );

    protected $fillable = array(
        'email',
        'name',
        'billing_address',
        'created_at',
        'updated_at',
        'update_cache',
    );

    /* -- Relations -- */
    public function subscription() { return $this->hasOne('Subscription'); }

    /**
     * createDefaultProfile
     * Creating a default profile for the user including
     * settings, background, subscription.
     */
    public function createDefaultProfile() {
        /* Create default subscription for the user */
        $plan = Plan::first();
        $subscription = new Subscription(array(
            'status'       => 'active',
        ));
        $subscription->user()->associate($this);
        $subscription->plan()->associate($plan);
        $subscription->save();
    }
}
