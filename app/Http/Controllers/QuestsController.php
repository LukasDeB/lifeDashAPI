<?php

namespace App\Http\Controllers;

use App\Quest;
use \Input;
use Illuminate\Http\Request;
use \Unisharp\FileApi\FileApi;

class QuestsController extends Controller
{
    protected $uploadPath = '/uploads/quests';

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

    public function uploadIcon(Request $req, Quest $quest) {
        try {
            $fa = new FileApi($this->uploadPath);
            dd($req, $quest, $fa);
            $file = $fa->save($req->files->get('image'));
            $quest->update([ 'icon' => $file ]);
    
            return $quest;
        } catch (\Error $err) {
            dd($err);
        }
    }

    public function icon(Request $req, Quest $quest) {
        $fa = new FileApi($this->uploadPath);

        return $fa->getResponse($quest->icon);
    }
}
