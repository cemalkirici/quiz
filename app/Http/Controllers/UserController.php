<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Promise\all;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index()
    {
         //$users = DB::table('users');
          $users = user::where('id','>',0);

        $adminsayi = DB::table('users')->where('type','=','admin')->count();
        $usersayi = DB::table('users')->where('type','=','user')->count();


        //paginate sorunu var, hem filtre hem paginate gondermiyor - ok
        //admin ve user sayisini bulalim bugun - ok

        if( request()->get('name')){
             $users = $users->where('name','LIKE',"%".request()->get('name')."%");
        }
        if( request()->get('type')){
            $users = $users->where('type',request()->get('type'));
        }
         $users = $users->paginate(10);

       return view('admin.user.list',compact('users','adminsayi','usersayi'));
        }



    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $users = User::find($id);
        return view('admin.user.edit',compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {

        $user = User::find($id) ?? abort(404,'Quiz Not Found');

        User::where("id", $id)->first()->update($request->except(["_method", "_token"]));

        return redirect()->route('users.index')->withSuccess('Quiz Updated Safe And Sound');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
