<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class Menu extends Component
{
    public $menu;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {

        $arrMenu = collect(config('adminMenu'))->map(function ($item){
                if(isset($item['submenu'])) {
                    $parentActive = false;
                    foreach ($item['submenu'] as $k => $subItem){
                        $item['submenu'][$k]["active"] = request()->routeIs($subItem["route"]);

                        if($item['submenu'][$k]["active"])
                            $parentActive = true;
                    }
                    $item["active"] = $parentActive;
                } else {
                    $item["active"] = request()->routeIs($item["route"]);
                }
            return $item;
        });

        $this->menu = $arrMenu;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.menu');
    }
}
