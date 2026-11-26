<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortofolioController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function about()
    {
        return view('about');
    }

    public function services()
    {
        $films = [
            [
                'film_number'  => '01',
                'title'        => 'Your Name.',
                'release_year' => '2016',
                'genre'        => 'Romance / Fantasy',
                'poster_path'  => 'assets/img/1.jpg',
                'description'  => 'Dua remaja yang terhubung secara misterius melalui pertukaran tubuh melintasi ruang dan waktu.'
            ],
            [
                'film_number'  => '02',
                'title'        => 'Weathering With You',
                'release_year' => '2019',
                'genre'        => 'Drama / Fantasy',
                'poster_path'  => 'assets/img/2.jpg',
                'description'  => 'Kisah seorang remaja di Tokyo yang bertemu gadis dengan kemampuan mengendalikan cuaca.'
            ],
            [
                'film_number'  => '03',
                'title'        => 'Suzume',
                'release_year' => '2022',
                'genre'        => 'Adventure / Fantasy',
                'poster_path'  => 'assets/img/3.jpg',
                'description'  => 'Perjalanan melintasi Jepang untuk menutup pintu-pintu misterius yang membawa bencana.'
            ],
            [
                'film_number'  => '04',
                'title'        => '5 Centimeters per Second',
                'release_year' => '2007',
                'genre'        => 'Drama / Romance',
                'poster_path'  => 'assets/img/4.jpg',
                'description'  => 'Kisah tentang jarak, kenangan, dan hubungan yang berubah perlahan seiring berjalannya waktu.'
            ],
            [
                'film_number'  => '05',
                'title'        => 'The Garden of Words',
                'release_year' => '2013',
                'genre'        => 'Drama / Romance',
                'poster_path'  => 'assets/img/5.jpg',
                'description'  => 'Pertemuan dua orang asing di sebuah taman saat hujan, yang perlahan menjadi ruang untuk saling memahami.'
            ],
            [
                'film_number'  => '06',
                'title'        => 'Children Who Chase Lost Voices',
                'release_year' => '2011',
                'genre'        => 'Adventure / Fantasy',
                'poster_path'  => 'assets/img/6.jpg',
                'description'  => 'Petualangan menuju dunia tersembunyi yang mengeksplorasi kehilangan dan keberanian untuk melangkah.'
            ],
        ];

        return view('services', ['films' => $films]);
    }

    public function contact()
    {
        return view('contact');
    }
}
