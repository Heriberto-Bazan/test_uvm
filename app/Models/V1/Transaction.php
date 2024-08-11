<?php

namespace App\Models\V1;

use Padosoft\Sluggable\HasSlug;
use Padosoft\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory, HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'customer_name', 'identification_documents_id', 'description', 'value', 'statuses_id', 'slug', 'payment_methods_id', 'payment_date', 'total_percentage', 'status_transaction'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('statuses_id')
            ->saveSlugsTo('slug')
            ->allowDuplicateSlugs();
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug'; 
    }

     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    
}
