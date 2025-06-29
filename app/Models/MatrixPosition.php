<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatrixPosition extends Model
{
    protected $fillable = ['user_id','parent_id','position_index','depth'];

    public function user()   { return $this->belongsTo(User::class); }
    public function parent() { return $this->belongsTo(MatrixPosition::class,'parent_id'); }
    // public function children(){ return $this->hasMany(MatrixPosition::class,'parent_id'); }


    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }    
}
