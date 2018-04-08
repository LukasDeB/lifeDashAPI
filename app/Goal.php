<?php

namespace App;

use App\Quest;
use App\SavingsGoal;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    protected $fillable = [
        'user_id',
        'description',
        'type',
        'parent_id',
        'completed',
    ];

    public static function createType(array $attributes = []) {
        if(isset($attributes['quest_ids'])) {
            $quests = Quest::findMany($attributes['quest_ids']);
        }

        $goal = static::query()->create($attributes);
        switch($attributes['type']) {
            case config('constants.goalTypes.savings'): {
                $typeGoal = SavingsGoal::create(array_merge(
                    ['goal_id' => $goal->id],
                    $attributes
                ));
            } break;
            case config('constants.goalTypes.generic'):
            default:
            break;
        }

        if(isset($quests) && !empty($quests)) {
            foreach($quests as $quest) {
                $quest->goals()->attach($goal->id);
            }
        }

        return ['goal' => $goal, 'typeData' => $typeGoal];
    }

    public function quests() {
        return $this->belongsToMany('App\Quest');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function savingsGoal() {
        return $this->hasMany('App\SavingsGoal');
    }
    public function children() {
        return $this->hasMany('App\Goal', 'parent_id');
    }
}
