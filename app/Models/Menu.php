<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = ['restaurant', 'year', 'week', 'caption', 'text'];
    protected $primaryKey = ['restaurant', 'year', 'week'];
    public $incrementing = false;
    protected $casts = [
        'restaurant' => 'int',
        'year'=> 'int',
        'week' => 'int',
        'caption' => 'string',
        'text' => 'string'
    ];

    protected $appends = ['days', 'changed'];



    public function getDaysAttribute() {
        $days = [];
        $date = new \DateTime();
        $date->setISODate($this->year,$this->week);

        for($i=0; $i<7; $i++) {
            $day = [
                'day' => $i,
                'date' => $date->format("j.n.Y"),
                'meals' => []
            ];
            foreach(MenuMeal::where(['restaurant' => $this->restaurant, 'year' => $this->year, 'week' => $this->week, 'day' => $i])->get() as $meal) {
                $day['meals'][] = $meal;
            }
            $days[] = $day;
            $date->modify('+1 day');
        }
        return $days;
    }

    public function getChangedAttribute() {
        return false;
    }


}
