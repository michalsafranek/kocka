<?php

namespace App\Http\Controllers;

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
    public function index(Request $r) {
        return view('menuAdmin.select');
    }

    public function manage(Request $r, $id) {
        $restaurant = Restaurant::where(['key' => $id])->first();
        return view('menuAdmin.list', compact('restaurant'));
    }

    public function emails(Request $r, $id) {
        $restaurant = Restaurant::where(['key' => $id])->first();
        return view('menuAdmin.emails', compact('restaurant'));
    }

    public function getMealHistory(Request $r, $id) {
        return MealHistory::where(['restaurantId' => $id])->get();
    }

    public function getMenus(Request $r, $id) {

        $ret = ['menus' => []];
        $date = new \DateTime();

        // První datum 3 týdny zpět
        $date->modify('-3 weeks');
        $this->setMonday($date);

        // W: Week number, N: Day in week (1-7)


        for($i=0; $i<6; $i++) {
            $dateSunday = $this->getSunday($date);
            //echo $date->format("Y-W").": ".$date->format('j.n.Y')."-".$dateSunday->format('j.n.Y')."\n";

            $menu = $this->getMenuForDate($date, $id);
            $ret['menus'][] = $menu;

            $date->modify('+1 week');
        }

        return $ret;
    }

    public function getEmails(Request $r, $id) {
        return MenuEmail::where(['restaurant' => $id])->get();
    }

    public function addEmail(Request $r, $id) {
        $validated = $r->validate([
            'email' => 'required|email',
        ]);
        $e = new MenuEmail();
        $e->restaurant = $id;
        $e->email = $validated['email'];
        $e->saveOrFail();
        return MenuEmail::where(['restaurant' => $id])->get();
    }

    public function deleteEmail(Request $r, $restaurant, $id) {
        $e = MenuEmail::where(['restaurant' => $restaurant, 'id' => $id])->delete();
        return MenuEmail::where(['restaurant' => $restaurant])->get();
    }

    private function setMonday(\DateTime &$date) {
        if($date->format('N') > 1) {
            $date->modify('-'.($date->format('N')-1).' days');
        }
    }

    public function saveMenu(Request $r, $restaurant) {
        $menu = $r->menu;
        MenuMeal::where([
            'restaurant' => $restaurant,
            'year' => $menu['year'],
            'week' => $menu['week']
        ])->delete();

        foreach($r->menu['days'] as $dayIndex => $day) {
            echo $dayIndex;
            foreach($day['meals'] as $mealIndex => $meal) {
                $m = new MenuMeal(['restaurant' => $restaurant, 'year' => $menu['year'], 'week' => $menu['week']]);
                $m->day = $dayIndex;
                $m->mealId = $mealIndex;
                $m->type = $meal['type'];
                $m->ammount = $meal['ammount'];
                $m->name = $meal['name']? $meal['name'] : '';
                $m->price = $meal['price'] ? $meal['price'] : '0.00';
                $m->alergens = $meal['alergens'] ? $meal['alergens'] : '';
                $m->save();
            }
        }

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

    public function emailPdf(Request $r, $restaurant, $year, $week) {
        $menu = Menu::where(['restaurant' => $restaurant, 'year' => $year, 'week' => $week])->first();
        $emails = MenuEmail::where(['restaurant' => $restaurant])->get();
        $restaurant = Restaurant::where(['id' => $restaurant])->first();
        return view('menuAdmin.sendEmails', compact('restaurant', 'menu', 'emails'));
    }

    public function sendEmail(Request $r) {

        Mail::to('ms@dobris.net')->send(new MenuEmail());
    }


    public function printPdf(Request $r, $restaurant, $year, $week) {
        $menu = Menu::where(['restaurant' => $restaurant, 'year' => $year, 'week' => $week])->first();
        $mpdf = new Mpdf(['utf-8']);
        $daysHtml = '';



        foreach($menu->days as $day){
            if(count($day['meals']) > 0) {
                $daysHtml .= '<h4>'.$this->dayName($day['day']).'</h4>';

                foreach($day['meals'] as $meal) {
                    if($meal->type == 'text') {
                        $daysHtml .= '<div style="text-align: center">'.$meal->name.'</div>';
                    }
                    else {
                        $daysHtml .= '<div><img src="/images/meal_icons/'.$meal->type.'.png" style="height: 12px;"> '.$meal->name.'......................'.$meal->price.' Kč</div>';
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
        <div style="text-align: right"><img id="logo" src="/images/logo_print/'.$restaurant.'.jpg"></div>
        <div style="text-align: center;">
            <h1>Nabídka poledního menu od '.$menu->caption.'</h1>
            '.$daysHtml.'
        </div>


        ');


        $mpdf->Output('poledni_menu.pdf', 'I');

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
