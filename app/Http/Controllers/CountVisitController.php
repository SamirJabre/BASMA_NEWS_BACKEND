<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CountVisitController extends Controller
{
    public function countCategoryClick(Request $request)
    {
        $category = Category::find($request->category_id);
        if ($category) {
            $category->clicks += 1;
            $category->save();
            return response()->json(['message' => 'Click counted successfully.']);
        } else {
            return response()->json(['message' => 'Category not found.'], 404);
        }
    }
}