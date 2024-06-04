<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use PhpParser\Node\Expr\New_;

class ForumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index','show');
    }

    public function index()
    {
        // Ambil semua post dari database
        $forumPosts = Forum::all();
        
        // Tampilkan view forum dengan data posts
        return view('forum.index', compact('forumPosts'));
    }

    public function create()
    {
        // Tampilkan form untuk membuat post baru
        return view('forum.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $sf = New Forum;
        $sf->user_id = Auth::user()->id;
        $sf->title = $request->title;
        $sf->body = $request->body;
        
        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $extension = $file->getClientOriginalExtension();
        //     $filename = time().'.'.$extension;
        //     $file->move('uploads/forumImages/', $filename);
        //     $sf->image = $filename;
        // }

        $sf->save();
        
        return redirect()->route('forum.index')->withInfo('success', 'Pertanyaan berhasil dibuat!');
    }
    
    public function edit($id)
    {
        $forum = Forum::find($id);
        return view('forum.edit', compact('forum'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $uf = Forum::find($id);
        $uf->user_id = Auth::user()->id;
        $uf->title = $request->title;
        $uf->body = $request->body;
        // if ($request->hasFile('image')) {

        //     $destination = 'uploads/forumImages/'.$uf->image;
        //     if(File::exists($destination))
        //     {
        //         File::delete($destination);
        //     }

        //     $file = $request->file('image');
        //     $extention = $file->getClientOriginalExtension();
        //     $filename = time().'.'.$extention;
        //     $file->move('uploads/forumImages/', $filename);
        //     $uf->image = $filename;
        // }

        $uf->save();
        return redirect()->route('forum.index', $uf->id)->withInfo('success', 'Pertanyaan berhasil diupdate!');
    }

    public function delete($id)
    {
        $df = Forum::findOrFail($id);
        $df->delete();
    
        return redirect()->route('forum.index')->withInfo('status', 'Forum berhasil dihapus!');
    }
    
    public function show($id)
    {
        $shf = Forum::find($id);
        return view('forum.show', compact('shf'));
    }
}
