<?php

namespace App\Http\Controllers;

use App\Models\Aggregate;
use Illuminate\Http\Request;

class AggregateController extends Controller
{
    public function increment_Nav(){
        $section = Aggregate::find(1);
        if ($section) {
            $section->navigation_clicks += 1;
            $section->save();
            return response()->json(['message' => 'Click counted successfully.'], 200);
        } else {
            return response()->json(['message' => 'Section not found.'], 404);
        }
    }
    public function increment_hero(){
        $section = Aggregate::find(1);
        if ($section) {
            $section->hero_section_clicks += 1;
            $section->save();
            return response()->json(['message' => 'Click counted successfully.'], 200);
        } else {
            return response()->json(['message' => 'Section not found.'], 404);
        }
    }
    public function increment_News(){
        $section = Aggregate::find(1);
        if ($section) {
            $section->news_categories_clicks += 1;
            $section->save();
            return response()->json(['message' => 'Click counted successfully.'], 200);
        } else {
            return response()->json(['message' => 'Section not found.'], 404);
        }
    }
    public function increment_Most_read(){
        $section = Aggregate::find(1);
        if ($section) {
            $section->most_read_clicks += 1;
            $section->save();
            return response()->json(['message' => 'Click counted successfully.'], 200);
        } else {
            return response()->json(['message' => 'Section not found.'], 404);
        }
    }
    public function increment_Footer(){
        $section = Aggregate::find(1);
        if ($section) {
            $section->footer_clicks += 1;
            $section->save();
            return response()->json(['message' => 'Click counted successfully.'], 200);
        } else {
            return response()->json(['message' => 'Section not found.'], 404);
        }
    }
}
