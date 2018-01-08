<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $contact
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 */
class Supplier extends Model
{

    protected $table = 'suppliers';
    protected $fillable = ['name', 'contact_id'];

    public function contact()
    {
        return $this->belongsTo(ContactInformation::class, 'contact_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'supplier_id');
    }

}
