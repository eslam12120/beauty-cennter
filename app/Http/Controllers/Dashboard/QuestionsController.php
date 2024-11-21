<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionsController extends Controller
{
    //
    public function index()
    {
        $questions = Question::get();
        return view('dashboard.questions.index', compact('questions'));
    }
    public function create()
    {
        return view('dashboard.questions.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'content_ar' => 'required|string',
            'content_en' => 'required|string',
        ]);
        try {
            DB::beginTransaction();

        Question::create($request->all());
            DB::commit();

        return redirect()->route('question.index')->with('success', 'Question created successfully.');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('category.index')->with(['error' => 'Error occurred. Please try again']);
        }
    }

  

    public function edit( $id)
    {
        $question = Question::findOrFail($id); // Fetching the question to edit
        return view('dashboard.questions.edit', compact('question'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'content_ar' => 'required|string',
            'content_en' => 'required|string',
        ]);
        try {
            DB::beginTransaction();

        $question = Question::findOrFail($id); // Fetching the question to update

        $question->update($request->all());
            DB::commit();

        return redirect()->route('question.index')->with('success', 'Question updated successfully.');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('cquestion.index')->with(['error' => 'Error occurred. Please try again']);
        }
    }

    public function destroy($id)
    {
        $question=Question::where('id',$id)->delete();
    
        return redirect()->route('question.index')->with('success', 'Question deleted successfully.');
    }

}
