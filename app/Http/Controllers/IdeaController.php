<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use App\Models\Idea;
use Illuminate\Http\Request;


class IdeaController extends Controller
{
    //Creating Post/Content
    public function store(CreateIdeaRequest $request)
    {
        $validated = $request->validated();

        // $validated = request()->validate([
        //     'content' => 'required|min:3|max:240'
        // ]);

        //USING VALIDATE
        $validated['user_id'] = auth()->id();

        Idea::create($validated);

        return redirect()->route('dashboard')->with('success', 'Idea Created Successfully!');

        // dump(request()->all());
        // dd($validated);

        //LONG CODE
        // $idea = Idea::create([
        //         'content' => request()->get('content', null),
        //     ]
        // );

        //SHORT CODE
        // $idea = Idea::create(request()->all());
    }

    // public function destroy(Idea $idea){
    //     //where id=1;

    //     // $idea = Idea::where('id', $idea)->firstOrFail();
    //     $idea->delete();

    //     // Idea::where('id', $id)->firstOrFail()->delete(); //ONE LINE CODE

    //     return redirect()-> route('dashboard')->with('success', 'Idea Deleted Successfully!');
    // }

    //SHORTER TO DELETE
    public function destroy(Idea $idea)
    {

        // if(auth()->id() !==$idea->user_id){
        //     abort(404); //TO ABORT
        // }
        // $idea->delete();

        //GATE
        // $this->authorize('idea.delete', $idea);

        //POLICY
        $this->authorize('delete', $idea);

        $idea->delete();

        return redirect()->route('dashboard')->with('success', 'Idea Deleted Successfully!');
    }

    //Showing / Viewing specific Record/Content
    public function show(Idea $idea)
    {
        // return view('ideas.show', [
        //     'idea' => $idea
        // ]);
        return view('ideas.show', compact('idea')); //shorter code
    }

    //Editing
    public function edit(Idea $idea)
    {
        // if(auth()->id() !==$idea->user_id){
        //     abort(404,""); //TO ABORT
        // }

        //GATE
        // $this->authorize('idea.edit', $idea);
        //POLICY
        $this->authorize('update', $idea);

        $editing = true;

        return view('ideas.show', compact('idea', 'editing'));
        // return view('ideas.show', [
        //     'idea' => $idea,
        //     'editing' => $editing,
        // ]);


    }

    //Updating
    public function update(UpdateIdeaRequest $request, Idea $idea)
    {
        //CHECK IF CURRENT USER LOGGED IN TO UPDATE
        // if(auth()->id() !==$idea->user_id){
        //     abort(404,""); //TO ABORT
        // }

        //GATE
        // $this->authorize('idea.edit', $idea);

        //POLICY
        $this->authorize('update', $idea);

        $validated = $request->validated();

        $idea->update($validated);

        return redirect()->route('ideas.show', $idea->id)->with('success', "Idea Upated Successfully!");
    }
}
