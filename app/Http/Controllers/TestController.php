<?php

namespace App\Http\Controllers;

use App\Support\GiphyManager;

class TestController extends Controller
{
    /**
     * Just random output of Giphy
     *
     * @return Illuminate\View\View
     */
    public function random(GiphyManager $manager)
    {
        $data = $manager->random(); 

        $giphy = set_giphy($data);

        return view('test')
            ->with('giphy', $giphy)
        ; 
    }
}