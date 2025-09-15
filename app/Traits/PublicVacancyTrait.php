<?php

namespace App\Traits;

trait PublicVacancyTrait
{
    /**
     * Scope to get all vacancies regardless of creator (for public/frontend display)
     * This bypasses the MultiTenantModelTrait global scope
     */
    public function scopePublic($query)
    {
        return $query->withoutGlobalScope('created_by_id');
    }

    /**
     * Scope to get only open vacancies (public access)
     */
    public function scopePublicOpen($query)
    {
        return $query->public()->where(function($q) {
            $q->where('close_date', '>=', now())->orWhere('close_date_exist', 0);
        });
    }

    /**
     * Scope to get featured vacancies (public access)
     */
    public function scopePublicFeatured($query)
    {
        return $query->public()->where('featured', 1);
    }
}
