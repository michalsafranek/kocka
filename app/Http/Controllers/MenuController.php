<?php

namespace App\Http\Controllers;

use App\Models\MealHistory;
use App\Models\Menu;
use App\Models\MenuEmail;
use App\Models\MenuMeal;
use App\Models\Restaurant;
use Illuminate\Http\Request;

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

}
