<?php

namespace App\Http\Controllers;

use App\Models\Aggregate;
use App\Models\ClickLog;
use Carbon\Carbon;
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




    public function incrementSectionClick(Request $request)
    {
        $ipAddress = request()->ip();
        ClickLog::create([
            'section' => $request->section,
            'ip_address' => $ipAddress,
        ]);

        $aggregate = Aggregate::find(1);
        if ($aggregate) {
            $column = 'unique_'.$request->section.'_clicks';
            $aggregate->$column += 1;
            $aggregate->save();

            return response()->json(['message' => 'Click counted successfully.'], 200);
        } else {
            return response()->json(['message' => 'Section not found.'], 404);
        }
    }

    public function getUniqueClicks(Request $request)
    {
        $uniqueClicks = ClickLog::where('section', $request->section)
            ->where('created_at', '>=', Carbon::now()->subDay())
            ->distinct('ip_address')
            ->count('ip_address');

        return response()->json(['unique_clicks' => $uniqueClicks], 200);
    }







}
