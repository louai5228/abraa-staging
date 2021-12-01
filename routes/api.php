<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('get_table_data/{table_name}',function(Request $request){
    $columns = Schema::getColumnListing(\request()->route()->table_name);
    $items = DB::table(\request()->route()->table_name)->get();
    $ths = "";

    foreach ($columns as $column){
        $ths .= "<th style='border: 1px solid #aaaaaa'>$column</th>";
    }
    $head = "<thead><tr>$ths</tr></thead>";
    $trs = "";
    for($i=0 ; $i < $items->count(); $i++){
        $tds = "";
        foreach ($items[$i] as $value)
            $tds .= "<td style='border: 1px solid #aaaaaa'>$value</td>";
        $trs .= "<tr>$tds</tr>";
    }
    $body = "<tbody>$trs</tbody>";
    return "<table style='border: 1px solid #aaaaaa'>$head $body</table>";
});


Route::get('/migrate', function () {
    Artisan::call('migrate');
});

Route::get('export-database',function(){
    Artisan::call('backup:run');
});


Route::get('/show_all_tables', function () {
    $tables = DB::select('SHOW TABLES');
    echo '[';
    foreach ($tables as $table) {
        print_r($table);
    }
    echo ']';
});

Route::get('/show_table/{table_name}', function ($table_name) {

    return Schema::getColumnListing($table_name);

});

Route::get('/seed', function () {

    Artisan::call('db:seed');

});

Route::get('/storage_link', function () {

    Artisan::call('storage:link');

});
//
//Route::get('/drop_all_tables', function () {
//    Artisan::call('db:wipe');
//});

Route::get('config-cache', function () {
    $exitCode = Artisan::call('config:cache');
    return '<h1>cache config cleared!</h1>';
});

Route::get('optimize', function () {
    $exitCode = Artisan::call('optimize');
    return '<h1>optimize!</h1>';
});

Route::get('/dump_autoload', function()
{
    Artisan::call('dump-autoload');
    echo '<h1>dump-autoload complete</h1>';
});
