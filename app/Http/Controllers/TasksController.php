<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $tasks = Tasks::all();

        $message = $tasks->isEmpty() ? 'There is nothing here.' : 'OK';

        return response()->json([
            'tasks' => $tasks,
            'message' => $message,
            'status' => 200
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|max:100'
        ]);

        try {
            Tasks::create([
                'title' => $request->title
            ]);
    
            return response()->json([
                'message' => 'Created successfully',
                'status' => 201
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        $request->validate([
            'title' => 'nullable|max:100',
            'finished' => 'nullable|boolean'
        ]);

        try {
            $task = Tasks::findOrFail($id);

            if ($request->has('title')) {
                $task->title = $request->title;
            }
            
            if ($request->has('finished')) {
                $task->finished = $request->finished;
            }

            $task->save();
    
            return response()->json([
                'message' => 'Updated successfully',
                'status' => 200
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        try {
            $task = Tasks::findOrFail($id);

            $task->delete();
    
            return response()->json([
                'message' => 'Deleted successfully',
                'status' => 200
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }
}