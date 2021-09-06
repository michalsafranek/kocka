<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Mpdf\Mpdf;

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

    public function getPdf(): Mpdf {
        $mpdf = new Mpdf(['utf-8']);
        $daysHtml = '';



        foreach($this->days as $day){
            if(count($day['meals']) > 0) {
                $daysHtml .= '<h4>'.$this->dayName($day['day']).'</h4>';

                foreach($day['meals'] as $meal) {
                    if($meal->type == 'text') {
                        $daysHtml .= '<div style="text-align: center">'.$meal->name.'</div>';
                    }
                    else {
                        $daysHtml .= '<div><img src="images/meal_icons/'.$meal->type.'.png" style="height: 12px;"> <span style="font-size: 10px">'.$meal->ammount.'</span> '.$meal->name.'......................'.$meal->price.' Kč</div>';
                    }

                }
            }

        }


        $mpdf->WriteHTML('
        <style>
            body { font-size: 10pt; }
            h1 { font-family: cambria; font-weight: bold; font-size: 16pt; text-decoration: underline;}
            img#logo { width: 4cm;}
        </style>
        <div style="text-align: right"><img id="logo" src="images/logo_print/'.$this->restaurant.'.jpg"></div>
        <div style="text-align: center;">
            <h1>Nabídka poledního menu od '.$this->caption.'</h1>
            '.$daysHtml.'
        </div>


        ');


        return $mpdf;

    }

    private function dayName($num) {
        switch($num) {
            case 0: return "Pondělí";
            case 1: return "Úterý";
            case 2: return "Středa";
            case 3: return "Čtvrtek";
            case 4: return "Pátek";
            case 5: return "Sobota";
            case 6: return "Neděle";
        }
    }


}
