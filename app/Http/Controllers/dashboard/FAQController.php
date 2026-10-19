<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFAQRequest;
use App\Http\Requests\UpdateFAQRequest;
use App\Models\FAQ;
use App\Notifications\FAQUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = FAQ::with("author")->latest()->get();
        return view("dashboard.faqManagement.index", compact("faqs"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFAQRequest $request)
    {
        // 1 : Create a record :
        FAQ::create([
            "question" => $request->question,
            "answer" => $request->answer,
            "author_id" => Auth::id(),
        ]);
        flash()->success("Added Sucssesfully");
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(FAQ $fAQ)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FAQ $fAQ)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFAQRequest $request, string $fAQ)
    {
       $FAQ= FAQ::findorfail($fAQ);
       $FAQ->update([
            "question" => $request->question,
            "answer" => $request->answer,
        ]);
        $FAQ->load("author");

        // dump($FAQ);
        // dd(Auth::id());
        if (Auth::id() != $FAQ->author->id) {
            $FAQ->author->notify(new FAQUpdate($FAQ->author->name, Auth::user()->name));
        }


        flash()->success("Updated Sucssesfully");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $fAQ)
    {
        FAQ::destroy($fAQ);
        flash()->success("Deleted Sucssesfully");

        return redirect()->back();
    }
    public function search($query = '')
    {
        $faqs = FAQ::with('author')
            ->where('question', 'LIKE', "%{$query}%")
            ->orWhereHas('author', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->latest()
            ->get();

        $results = $faqs->map(function ($faq) {
            return [
                'id' => $faq->id,
                'question' => $faq->question,
                'author_name' => $faq->author->name ?? 'Admin'
            ];
        });

        return response()->json($results);
    }
}
