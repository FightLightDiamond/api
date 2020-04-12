<?php

namespace Tutorial\Models;

use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class SectionResult extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'section_results';
    public $fillable = ['created_by', 'section_id', 'score'];

    public function scopeFilter($query, $input)
    {
        if(isset($input['created_by'])) {
                $query->where('created_by', $input['created_by']); 
                }
if(isset($input['section_id'])) {
                $query->where('section_id', $input['section_id']); 
                }
if(isset($input['score'])) {
                $query->where('score', $input['score']); 
                }

        return $query;
    }


    public $fileUpload = ['image' => 1];
    protected $pathUpload = ['image' => '/images/section_results'];
    protected $thumbImage = [
        'image' => [
            '/thumbs/' => [
                [200, 200], [300, 300], [400, 400]
            ]
        ]
    ];
    protected $checkbox = ['is_active'];
}

