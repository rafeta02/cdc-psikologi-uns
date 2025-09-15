<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use App\Traits\PublicVacancyTrait;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Cviebrock\EloquentSluggable\Sluggable;

class Vacancy extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, PublicVacancyTrait, InteractsWithMedia, Auditable, HasFactory, Sluggable;

    public $table = 'vacancies';

    protected $dates = [
        'open_date',
        'close_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const TYPE_SELECT = [
        'fulltime'   => 'Fulltime',
        'parttime'    => 'Parttime',
        'internship' => 'Internship',
    ];

    protected $fillable = [
        'name',
        'slug',
        'company_id',
        'description',
        'type',
        'open_date',
        'close_date_exist',
        'close_date',
        'persyaratan_umum',
        'persyaratan_khusus',
        'registration',
        'job_description',
        'experience_id',
        'minimum_gpa',
        'position_id',
        'industry_id',
        'featured',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['name', 'company_name'],
                'separator' => '-', // Custom separator
                'maxLength' => 50, // Maximum length of the slug
            ]
        ];
    }

    public function getCompanyNameAttribute()
    {
        return $this->company ? $this->company->name : '';
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function getOpenDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setOpenDateAttribute($value)
    {
        $this->attributes['open_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getCloseDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setCloseDateAttribute($value)
    {
        $this->attributes['close_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function experience()
    {
        return $this->belongsTo(Experience::class, 'experience_id');
    }

    public function education()
    {
        return $this->belongsToMany(Education::class);
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function tags()
    {
        return $this->belongsToMany(VacancyTag::class);
    }

    public function industry()
    {
        return $this->belongsTo(Industry::class, 'industry_id');
    }

    public function locations()
    {
        return $this->belongsToMany(Regency::class);
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
