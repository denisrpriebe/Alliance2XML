<?php

namespace App\Controllers\Auth\Font;

use App\Controllers\Controller;
use App\Facades\Components\View;
use App\Facades\Components\Nav;
use App\Models\Font;
use App\Models\Setting;
use App\Facades\Components\Input;
use App\Facades\Components\Session;
use App\Facades\Components\Redirect;

class FontController extends Controller {

    public function showFonts() {

        Nav::setActiveTabs(['fonts']);

        View::add('fonts', Font::all());
        View::add('settings', Setting::first());
        View::show('pages/auth/fonts');
    }

    public function addFont() {

        $font = new Font;
        $font->code = Input::post('code');
        $font->name = Input::post('name');
        $font->roman_id = Input::post('roman_id') == '' ? null : Input::post('roman_id');
        $font->use_default = Input::post('use_default');
        $font->save();

        Session::flash('alert', [
            'type' => 'success',
            'title' => 'Font Added',
            'text' => $font->name . ' has been successfully added to the system.'
        ]);

        Redirect::route('auth-font-page');
    }

}
