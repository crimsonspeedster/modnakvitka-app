<?php

namespace App\Http\Controllers;

use App\Enums\EntityType;
use App\Models\Slug;
use Illuminate\Http\Request;

class ResolveSlugController extends Controller
{
    public function index(string $slug) {
        $slug = Slug::where('slug', $slug)->firstOrFail();

        $translations = $slug->translations()->map(function ($s) {
            return [
                'lang' => $s->lang->code,
                'slug' => $s->slug,
            ];
        });

        return response()->json([
            'id' => $slug->entity_id,
            'type' => EntityType::fromModel($slug->entity_type)->value,
            'translations' => $translations,
        ]);
    }
}
