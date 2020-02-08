<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/test-video', function () {
    return view('partials.youtube-video-player');
});

// แสดงรายการ ซีรีย์/ตอน index
Route::get('/series', function(){
    $series = \App\Serie::all();
    return view('serie.index')->with(['series'=>$series]);
})->name('series');

// แสดงฟอร์มสร้าง ซีรีย์/ตอน
Route::get('/series/create', function(){
    return view('serie.create');
});

Route::get('/series/{id}/episodes/create', function($serieid){
    return view('episode.create')->with(['serieId'=> $serieid]);
});


// รับข้อมูลจากฟอร์มสร้าง ซีรีย์/ตอน แล้วบันทึกลงตาราง
Route::post('/series', function(){
    $data= \Request::all();
   // return $data;
    //{"_token":"tHg0C2fweM3I4urrTDPgeddD5VabOPsljd4okM4W","title":"132"}//
    \App\Serie::create($data);
    return redirect('series');
});

Route::post('/series/{id}/episodes', function($id){
    $data= \Request::all();
    $episode = \App\Episode::create($data);
    $episode->serie_id =$id;
    $episode->save();
    return redirect('/series/'. $id);
});

// แสดง ตอน ที่อยู่ในซีรีย์
Route::get('series/{serie}' ,function (\App\Serie $serie) {
   // return \App\Serie::find($id);
    // $serie = \App\Serie::find($id);
    // return template +data
    return view('serie.show')->with([ 'serie' =>$serie]);
});

// // แสดง ตอน ที่อยู่ในซีรีย์
// Route::get('series/{id}' ,function ($id) {
//     // return \App\Serie::find($id);
//      $serie = \App\Serie::find($id);
//      // return template +data
//      return view('serie.show')->with([ 'serie' =>$serie]);
//  });