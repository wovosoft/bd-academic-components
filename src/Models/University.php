<?php

namespace Wovosoft\BdAcademicComponents\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Wovosoft\BdAcademicComponents\Enums\InstitutionArea;
use Wovosoft\BdAcademicComponents\Enums\InstitutionGeography;
use Wovosoft\BdAcademicComponents\Enums\InstitutionLevel;
use Wovosoft\BdAcademicComponents\Enums\InstitutionManagementType;
use Wovosoft\BdAcademicComponents\Enums\InstitutionType;
use Wovosoft\BdAcademicComponents\Enums\StudyType;
use Wovosoft\BdGeocode\Models\District;
use Wovosoft\BdGeocode\Models\Upazila;

/**
 * Wovosoft\BdAcademicComponents\Models\University
 *
 * @property int $id
 * @property string $name
 * @property string|null $bn_name
 * @property int|null $district_id
 * @property int|null $upazila_id
 * @property string|null $post_office
 * @property string|null $phone
 * @property InstitutionType|null $type
 * @property InstitutionManagementType|null $management
 * @property InstitutionLevel|null $level
 * @property string|null $code
 * @property StudyType|null $study_type
 * @property InstitutionArea|null $area
 * @property InstitutionGeography|null $geography
 * @property string|null $logo
 * @property string|null $address
 * @property string|null $website
 * @property string|null $details
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read District|null $district
 * @property-read Upazila|null $upazila
 * @method static \Illuminate\Database\Eloquent\Builder|University newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|University newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|University query()
 * @method static \Illuminate\Database\Eloquent\Builder|University whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|University whereArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|University whereBnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|University whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|University whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|University whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|University whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|University whereGeography($value)
 * @method static \Illuminate\Database\Eloquent\Builder|University whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|University whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|University whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|University whereManagement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|University whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|University wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|University wherePostOffice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|University whereStudyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|University whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|University whereUpazilaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|University whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|University whereWebsite($value)
 * @mixin \Eloquent
 */
class University extends Model
{
    use HasFactory;

    protected $casts = [
        "type"       => InstitutionType::class,
        "level"      => InstitutionLevel::class,
        "management" => InstitutionManagementType::class,
        "study_type" => StudyType::class,
        "area"       => InstitutionArea::class,
        "geography"  => InstitutionGeography::class
    ];

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function upazila(): BelongsTo
    {
        return $this->belongsTo(Upazila::class);
    }
}
