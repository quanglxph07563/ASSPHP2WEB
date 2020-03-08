<?php
namespace Models;
use Models\baseModels;
use Illuminate\Database\Eloquent\Model;
class brandsModels extends Model{
    protected $table = "brands";
    protected $fillable = ['brand_name', 'country'];
    public $timestamps=false;
}

?>