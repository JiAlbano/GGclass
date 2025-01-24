<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulletinFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'bulletin_id',
        'file_path',
        'file_type',
        'filename'
    ];

   // Relationship with Bulletin
   public function bulletin()
   {
       return $this->belongsTo(Bulletin::class);
   }
}