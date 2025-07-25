<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Template;

class TemplateController extends Controller
{
    public function index()
    {
        $templates = Template::with('templateExercises.exercise')
            ->active()
            ->get();

        return response()->json([
            'data' => $templates,
        ]);
    }

    public function show(Template $template)
    {
        if (! $template->is_active) {
            abort(404);
        }

        $template->load('templateExercises.exercise');

        return response()->json([
            'data' => $template,
        ]);
    }
}
