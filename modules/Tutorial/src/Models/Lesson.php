<?php

namespace Tutorial\Models;


use ACL\Models\Admin;
use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Lesson extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'lessons';
    public $fillable = ['title', 'intro', 'content', 'section_id', 'views', 'last_view', 'created_by', 'updated_by', 'is_active', 'no'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tests()
    {
        return $this->hasMany(LessonTest::class, 'lesson_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function results()
    {
        return $this->hasMany(LessonResult::class, 'lesson_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updater()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }

    /**
     * @var array
     */
    public $fileUpload = ['image' => 1];

    /**
     * @var array
     */
    protected $pathUpload = ['image' => '/images/lessons'];

    /**
     * @var array
     */
    protected $thumbImage = [
        'image' => [
            '/thumbs/' => [
                [200, 200], [300, 300], [400, 400]
            ]
        ]
    ];

    /**
     * @var array
     */
    protected $checkbox = ['is_active'];
}

