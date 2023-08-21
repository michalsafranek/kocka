<?php

namespace App\Http\Controllers;

use App\Mail\SendMenu;
use App\Models\MealHistory;
use App\Models\Menu;
use App\Models\MenuEmail;
use App\Models\MenuMeal;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Mpdf\Mpdf;

class MenuController extends Controller
{



    private function setMonday(\DateTime &$date) {
        if($date->format('N') > 1) {
            $date->modify('-'.($date->format('N')-1).' days');
        }
    }




    private function getSunday(\DateTime $date): \DateTime {
        $sunday = clone $date;
        return $sunday->modify('+6 days');
    }


    private function getMenuForDate(\DateTime $date, $restaurantId): Menu {
        $monday = clone $date;
        $this->setMonday($monday);
        $caption = $monday->format("j.n.");
        $caption .= ' - '.$this->getSunday($monday)->format('j.n.Y');
        return Menu::where(['restaurant'=> $restaurantId, 'year' => $date->format('Y'), 'week' => $date->format('W')])
            ->firstOrCreate([
                'restaurant' => $restaurantId,
                'year' => $date->format('Y'),
                'week' => $date->format('W'),
                'caption' => $caption,
                'text' => ''
            ]);
    }

    public function todayMenu() {

        $ret = [];
        $today = new \DateTime();
        $todayMenu = $this->getMenuForDate($today, 1);
        $today->modify('+7 days');
        $nextWeekMenu = $this->getMenuForDate($today, 1);



        $ret['year'] = $todayMenu['year'];
        $ret['week'] = $todayMenu['week'];
        $ret['caption'] = $todayMenu['caption'];
        $ret['days'] = $todayMenu['days'];
        $ret['days'][7] = $nextWeekMenu['days'][0];

        $dow = date('N')-1;

        $ret['today'] = $ret['days'][$dow];
        $ret['tommorow'] = $ret['days'][$dow+1];

        return $ret;
    }

}
