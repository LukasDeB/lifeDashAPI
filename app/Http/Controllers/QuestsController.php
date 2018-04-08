<?php

namespace App\Http\Controllers;

use App\Quest;
use Illuminate\Http\Request;

class QuestsController extends Controller
{
    public function index(Request $req) {
        return Quest::with('goals.savingsGoal')->get();
    }

    public function show(Request $req, $id) {
        return Quest::findOrFail($id);
    }

    public function create(Request $req) {
        $quest = Quest::create($req->all());

        return response()->json($quest, 201);
    }

    public function update(Request $req, Quest $quest) {
        $quest->update($req->all());

        return response()->json($quest, 200);
    }

    public function delete(Request $req, Quest $quest) {
        $quest->delete();

        return response()->json(null, 204);
    }
}
