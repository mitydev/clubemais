<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title','slug','template','meta_title','meta_description','is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function sections()
    {
        return $this->hasMany(PageSection::class)->orderBy('position');
    }

    /** Tipos permitidos pelo template da página (ou todos, se não houver template) */
    public function allowedSectionKeys(): array
    {
        $all = config('pagebuilder.sections', []);
        $tpls = config('pagebuilder.templates', []);
        $tpl  = $this->template ?: 'default';

        if (isset($tpls[$tpl]['allowed_sections'])) {
            return array_values($tpls[$tpl]['allowed_sections']);
        }
        // default: se não tiver restrição, vale todos os keys
        return array_keys($all);
    }

    /** Sections ativas, já ordenadas */
    public function activeSections()
    {
        return $this->sections()->where('is_active', true);
    }
}
