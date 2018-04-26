<?php
namespace Models;
use Illuminate\Database\Eloquent\Model;
class Link extends Model
{
    protected $guarded = [];
    protected $table = 'link';
    public $timestamps = false;
    //protected $appends = ['comments'];
    public function comentarios() {
      return $this->hasMany('\Models\Comentario')->orderBy('id', 'desc');
    }
/*     public function getCommentsAttribute() {
      return $this->comments()->count();
    } */
}
