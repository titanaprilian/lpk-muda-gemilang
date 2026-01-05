<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\GalleryImage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $programs = Program::where("is_active", true)->get();

        $galleryImages = GalleryImage::where("is_public", true)
            ->orderBy("upload_date", "desc")
            ->get();

        return view("public.home", compact("programs", "galleryImages"));
    }

    /**
     * Show the program detail page.
     */
    public function show($slug)
    {
        // Fetch program by slug, ensure it is active
        $program = Program::where("slug", $slug)
            ->where("is_active", true)
            ->firstOrFail();

        return view("public.program-detail", compact("program"));
    }
}
