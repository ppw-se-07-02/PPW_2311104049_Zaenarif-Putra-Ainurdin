<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kapster extends Model
{
    protected $fillable = [
        'nama','email','no_hp','umur','tanggal_masuk',
        'admin_id','outlet_id','shift_id'
    ];

    public function admin(){ return $this->belongsTo(Admin::class); }
    public function outlet(){ return $this->belongsTo(Outlet::class); }
    public function shift(){ return $this->belongsTo(Shift::class); }
}
