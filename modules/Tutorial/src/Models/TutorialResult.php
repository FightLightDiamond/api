<?php

namespace Tutorial\Models;

use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class TutorialResult extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'tutorial_results';
    public $fillable = ['created_by', 'tutorial_id', 'score'];

    public function scopeFilter($query, $input)
    {
        if (isset($input['created_by'])) {
            $query->where('created_by', $input['created_by']);
        }
        if (isset($input['tutorial_id'])) {
            $query->where('tutorial_id', $input['tutorial_id']);
        }
        if (isset($input['score'])) {
            $query->where('score', $input['score']);
        }

        return $query;
    }

    public function tutorial()
    {
        return $this->belongsTo(Tutorial::class, 'tutorial_id');
    }

    public $fileUpload = ['image' => 1];
    protected $pathUpload = ['image' => '/images/tutorial_results'];
    protected $thumbImage = [
        'image' => [
            '/thumbs/' => [
                [200, 200], [300, 300], [400, 400]
            ]
        ]
    ];
    protected $checkbox = ['is_active'];
}

