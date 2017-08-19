<?php
/**
 * Created by PhpStorm.
 * Date: 8/15/17
 * Time: 11:07 PM
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Notes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class NotesController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Notes::where('created_by',Auth::user()->id)->get();
        return view('notes.index',array('notes'=>$notes));
    }


    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $note = new Notes();
        $note->created_by = Auth::user()->id;
        $note->title =  Input::get('title');
        $note->content = Input::get('content');
        $note->save();
        $notes = Notes::where('created_by',Auth::user()->id)->get();
        return view('notes.index',array('notes'=>$notes));
    }


    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function show($id)
    {
        $note = Notes::findOrFail($id);
        $notes = Notes::where('created_by',Auth::user()->id)->get();
        return view('notes.index',array('note'=>$note,'notes'=>$notes));
    }

    public function update($id)
    {
        $note = Notes::findOrFail($id);
        if($note){
            $note->content = Input::get('content');
            $note->title = Input::get('title');
            $note->updated_at = \Carbon\Carbon::now();
            $note->save();
        }
        $notes = Notes::where('created_by',Auth::user()->id)->get();
        return view('notes.index',array('notes'=>$notes));
    }

    public function destroy($id)
    {
        $note = Notes::findOrFail($id);
        $note->delete();
        $notes = Notes::where('created_by',Auth::user()->id)->get();
        return view('notes.index',array('notes'=>$notes));
    }

}
