<?php
namespace Models;
use Illuminate\Database\Eloquent\Model;
class Comentario extends Model
{
    protected $guarded = [];
    protected $table = 'comentario';
    public $timestamps = false;
    public function link() {
      return $this->belongsTo('\Models\Link');
    }
}
