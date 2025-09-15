<?php

namespace App\Traits;

trait PublicPostTrait
{
    /**
     * Scope to get all posts regardless of creator (for public/frontend display)
     * This bypasses the MultiTenantModelTrait global scope
     */
    public function scopePublic($query)
    {
        return $query->withoutGlobalScope('created_by_id');
    }

    /**
     * Scope to get only published posts (public access)
     */
    public function scopePublicPublished($query)
    {
        return $query->public()->where('status', 'published');
    }

    /**
     * Scope to get featured posts (public access)
     */
    public function scopePublicFeatured($query)
    {
        return $query->public()->where('featured', 1)->where('status', 'published');
    }

    /**
     * Scope to get posts by category (public access)
     */
    public function scopePublicByCategory($query, $categorySlug)
    {
        return $query->public()
            ->whereHas('categories', function ($query) use ($categorySlug) {
                $query->where('slug', $categorySlug);
            })
            ->where('status', 'published');
    }
}
