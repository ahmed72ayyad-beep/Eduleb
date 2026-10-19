<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function  index()  {
        $faqs=FAQ::with("author")->latest()->simplePaginate(7);
        return view("faq",compact("faqs"));
    }
}
