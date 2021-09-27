<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Http\Requests\QuizCreateRequest;
use App\Http\Requests\QuizUpdateRequest;
use Illuminate\Http\Response;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $quizzes = Quiz::withCount('questions');

        if(request()->get('title')){
            $quizzes = $quizzes->where('title','LIKE',"%".request()->get('title')."%");
        }
        if(request()->get('status')){
            $quizzes = $quizzes->where('status',request()->get('status'));
        }
        $quizzes = $quizzes->paginate(5);
        return view('admin.quiz.list',compact('quizzes'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.quiz.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(QuizCreateRequest $request)
    {
        Quiz::create($request->post());
        return redirect()->route('quizzes.index')->withSuccess('Job Well Done');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $quiz = Quiz::with('topTen.user','results.user')->withCount('questions')->find($id) ?? abort(404, 'Quiz Not Found');

        return view('admin.quiz.show', compact('quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $quiz = Quiz::withCount('questions')->find($id) ?? abort(404,'Quiz Not Found');
        return view('admin.quiz.edit',compact('quiz'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(QuizUpdateRequest $request, $id)
    {
        $quiz = Quiz::find($id) ?? abort(404,'Quiz Not Found');

        Quiz::where("id", $id)->first()->update($request->except(["_method", "_token"]));

        return redirect()->route('quizzes.index')->withSuccess('Quiz Updated Safe And Sound');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $quiz = Quiz::find($id) ?? abort(404,'Yok kiiiiii');
        $quiz-> delete();
        return redirect()->route('quizzes.index')->withsuccess('Sildim ki onu ben');
    }
}
