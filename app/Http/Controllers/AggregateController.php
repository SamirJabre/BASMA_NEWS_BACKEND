<?php

namespace App\Http\Controllers;

use App\Models\Aggregate;
use App\Models\Category;
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

    public function increment_unique_navigation_clicks(Request $request)
    {
        $ipAddress = $request->ip();
        $existingLog = ClickLog::where('ip_address', $ipAddress)->first();
        if ($existingLog) {
            return response()->json(['message' => 'Click is not unique.'], 404);
        }
        ClickLog::create(['ip_address' => $ipAddress]);
        $aggregate = Aggregate::find(1);
        if ($aggregate) {
            $aggregate->unique_navigation_clicks += 1;
            $aggregate->save();

            return response()->json(['message' => 'Click counted successfully.'], 200);
        } else {
            return response()->json(['message' => 'Section not found.'], 404);
        }
    }

    public function increment_unique_hero_section_clicks(Request $request)
    {
        $ipAddress = $request->ip();
        $existingLog = ClickLog::where('ip_address', $ipAddress)->first();
        if ($existingLog) {
            return response()->json(['message' => 'Click is not unique.'], 404);
        }
        ClickLog::create(['ip_address' => $ipAddress]);
        $aggregate = Aggregate::find(1);
        if ($aggregate) {
            $aggregate->unique_hero_section_clicks += 1;
            $aggregate->save();

            return response()->json(['message' => 'Click counted successfully.'], 200);
        } else {
            return response()->json(['message' => 'Section not found.'], 404);
        }
    }

    public function increment_unique_news_categories_clicks(Request $request)
    {
        $ipAddress = $request->ip();
        $existingLog = ClickLog::where('ip_address', $ipAddress)->first();
        if ($existingLog) {
            return response()->json(['message' => 'Click is not unique.'], 404);
        }
        ClickLog::create(['ip_address' => $ipAddress]);
        $aggregate = Aggregate::find(1);
        if ($aggregate) {
            $aggregate->unique_news_categories_clicks += 1;
            $aggregate->save();

            return response()->json(['message' => 'Click counted successfully.'], 200);
        } else {
            return response()->json(['message' => 'Section not found.'], 404);
        }
    }
    
    public function increment_unique_most_read_clicks_clicks(Request $request)
    {
        $ipAddress = $request->ip();
        $existingLog = ClickLog::where('ip_address', $ipAddress)->first();
        if ($existingLog) {
            return response()->json(['message' => 'Click is not unique.'], 404);
        }
        ClickLog::create(['ip_address' => $ipAddress]);
        $aggregate = Aggregate::find(1);
        if ($aggregate) {
            $aggregate->unique_most_read_clicks += 1;
            $aggregate->save();

            return response()->json(['message' => 'Click counted successfully.'], 200);
        } else {
            return response()->json(['message' => 'Section not found.'], 404);
        }
    }


    public function increment_unique_footer_clicks(Request $request)
    {
        $ipAddress = $request->ip();
        $existingLog = ClickLog::where('ip_address', $ipAddress)->first();
        if ($existingLog) {
            return response()->json(['message' => 'Click is not unique.'], 404);
        }
        ClickLog::create(['ip_address' => $ipAddress]);
        $aggregate = Aggregate::find(1);
        if ($aggregate) {
            $aggregate->unique_footer_clicks += 1;
            $aggregate->save();

            return response()->json(['message' => 'Click counted successfully.'], 200);
        } else {
            return response()->json(['message' => 'Section not found.'], 404);
        }
    }


    public function getClicksByPeriod(Request $request, $period)
    {
        $periods = [
            '24_hours' => Carbon::now()->subDay(),
            'week' => Carbon::now()->subWeek(),
            'month' => Carbon::now()->subMonth(),
            'year' => Carbon::now()->subYear(),
        ];
    
        if (!array_key_exists($period, $periods)) {
            return response()->json(['message' => 'Invalid period.'], 400);
        }
    
        $startDate = $periods[$period];
    
        $totalClicks = Aggregate::selectRaw('
            SUM(navigation_clicks) as navigation_clicks,
            SUM(hero_section_clicks) as hero_section_clicks,
            SUM(news_categories_clicks) as news_categories_clicks,
            SUM(most_read_clicks) as most_read_clicks,
            SUM(footer_clicks) as footer_clicks
        ')
        ->where('created_at', '>=', $startDate)
        ->first();
    
        $uniqueClicks = Aggregate::selectRaw('
            SUM(unique_navigation_clicks) as unique_navigation_clicks,
            SUM(unique_hero_section_clicks) as unique_hero_section_clicks,
            SUM(unique_news_categories_clicks) as unique_news_categories_clicks,
            SUM(unique_most_read_clicks) as unique_most_read_clicks,
            SUM(unique_footer_clicks) as unique_footer_clicks
        ')
        ->where('created_at', '>=', $startDate)
        ->first();

    
        return response()->json([
            'total_clicks' => $totalClicks,
            'unique_clicks' => $uniqueClicks,
        ], 200);
    }



}
