<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\CompanyAbout;

class CompanyProfileController extends Controller
{
    public function about_us()
    {
        $data['about_us'] = CompanyAbout::select('title', 'about_us')->first();
        return view('about_us', $data);
    }

    public function privacy_policy()
    {
        $data['privacy_policy'] = CompanyAbout::select('p_p_title', 'privacy_policy')->first();
        return view('privacy_policy', $data);
    }


    public function terms_and_condition()
    {
        $data['term_and_condition'] = CompanyAbout::select('t_c_title', 'term_and_condition')->first();
        return view('term_and_condition', $data);
    }
}
