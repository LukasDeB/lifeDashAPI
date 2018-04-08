<?php

namespace App;

use App\Goal;

class SavingsGoal extends Goal
{
    protected $table = 'savings_goals';

    protected $fillable = [
        "goal_id",
        "reason",
        "targetAmount",
        "targetDate",
        "progress",
    ];

    protected $dates = [
        "targetDate",
    ];

    public function getProgressPercentage() {
        return ($this->progress / $this->target) * 100;
    }

    public function addProgress($amount = 0) {
        $this->update(['progress' => $this->progress + $amount]);

        return $this->progress;
    }

}
