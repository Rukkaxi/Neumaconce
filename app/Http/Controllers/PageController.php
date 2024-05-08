<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    public function index()
    {
        $indexPath = public_path('index.html');

        if (file_exists($indexPath)) {
            return response()->file($indexPath);
        } else {
            throw new FileNotFoundException($indexPath);
        }
    }

    public function about()
    {
        return response()->file(public_path('about.html'));
    }

    public function service()
    {
        return response()->file(public_path('service.html'));
    }

    public function contact()
    {
        return response()->file(public_path('contact.html'));
    }
    
    public function team()
    {
        return response()->file(public_path('team.html'));
    }

    public function testimonial()
    {
        return response()->file(public_path('testimonial.html'));
    }
}
