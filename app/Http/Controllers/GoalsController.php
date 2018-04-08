<?php

namespace App\Http\Controllers;

use App\Goal;
use App\SavingsGoal;
use Illuminate\Http\Request;

class GoalsController extends Controller
{
    public function index(Request $req) {
        return Goal::with('quests')->get();
    }

    public function show(Request $req, $id) {
        $goal = Goal::findOrFail($id);

        return $goal;
    }

    public function create(Request $req) {
        $goal = Goal::createType($req->all());

        return response()->json($goal, 201);
    }

    public function update(Request $req, Goal $goal) {
        $goal->update($req->all());

        return response()->json($goal, 200);
    }

    public function delete(Request $req, Goal $goal) {
        $goal->delete();

        return response()->json(null, 204);
    }

    public function subGoals(Request $req, Goal $goal) {
        return response()->json($goal->children, 200);
    }
    
    public function addSubGoal(Request $req, Goal $goal) {
        $subGoal = Goal::createType(array_merge($req->all(), ['parent_id' => $goal->id]));

        return response()->json($subGoal, 201);
    }

    public function removeSubGoal(Request $req, Goal $goal, Goal $subGoal) {
        $subGoal->delete();

        return response()->json($goal, 200);
    }

    // ***************** //
    // GOAL TYPE SAVINGS //
    // ***************** //
    public function addSavingsProgress(Request $request, SavingsGoal $goal) {
        $goal->addProgress($request['amount']);
        return array_merge($goal->toArray(), [
            'percentage' => $goal->getProgressPercentage()
        ]);
    }
}
