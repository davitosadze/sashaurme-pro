<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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



Route::get('backup', function () {
    Artisan::call('backup:clean --disable-notifications');
    Artisan::call('backup:run --only-db --disable-notifications');

    return '
    <center><h1 style="
    
    display: flex;

    height: 100vh;
    margin: auto;
    border-radius: 10px;
    align-items: center;
    font-size:40px;
    justify-content: center;
    color:#24b712;">სარეზერვო კოპია წარმატებით შეიქმნა. <br> შეგიძლიათ გამორთოთ კომპიუტერი!</h1></center>
    <script type="text/javascript">
    
        
    
    </script>';
});

Route::get("/", "DashboardController@index");
Route::get("/subProducts/{category_id}", "DashboardController@subProducts");
Route::get("/productDetails/{product_id}", "DashboardController@productDetails");

Route::get("/cancel-order/{order_id}", "DashboardController@cancelOrder");
Route::get("/cancel-order-front/{order_id}", "DashboardController@cancelOrderFront");



#ROUTES
Route::get('/back/login', 'Admin\AuthController@login');
Route::get('/back', 'Admin\AuthController@login');
Route::post('/back/auth', 'Admin\AuthController@auth');
Route::get('/back/logout', 'Admin\AuthController@logout');

Route::get("/pr", "PrintService@print");

Route::group(['middleware' => ['admin']], function() {

    Route::get("/back/dashboard", "Admin\DashboardController@index");
    Route::get("/back/categories", "Admin\CategoryController@index");
    
    Route::get("/back/categories/add", "Admin\CategoryController@add");
    Route::post("/back/categories/insert", "Admin\CategoryController@insert");
    
    Route::get("/back/categories/edit/{category_id}", "Admin\CategoryController@edit");
    Route::post("/back/categories/update/{category_id}", "Admin\CategoryController@update");
    
    Route::get("/back/categories/delete/{category_id}", "Admin\CategoryController@delete");

    #XORCIS XARJI
    Route::get("/back/xorcisxarji", "Admin\XorcisXarjiController@index");
    Route::get("/back/xorcisxarji/add", "Admin\XorcisXarjiController@add");
    Route::post("/back/xorcisxarji/insert", "Admin\XorcisXarjiController@insert");

    
    
    #PRODUCTS
    
    Route::get("/back/products", "Admin\ProductController@index");
    
    Route::get("/back/products/add", "Admin\ProductController@add");
    Route::post("/back/products/insert", "Admin\ProductController@insert");
    
    Route::get("/back/products/edit/{product_id}", "Admin\ProductController@edit");
    Route::post("/back/products/update/{product_id}", "Admin\ProductController@update");
    
    Route::get("/back/products/delete/{product_id}", "Admin\ProductController@delete");
    
    
    #SPRODUCTS
    Route::get("/back/sproducts", "Admin\SawyobisProductController@index");
    
    Route::get("/back/sproducts/add", "Admin\SawyobisProductController@add");
    Route::post("/back/sproducts/insert", "Admin\SawyobisProductController@insert");
    
    Route::get("/back/sproducts/edit/{product_id}", "Admin\SawyobisProductController@edit");
    Route::post("/back/sproducts/update/{product_id}", "Admin\SawyobisProductController@update");
    
    Route::get("/back/sproducts/delete/{product_id}", "Admin\SawyobisProductController@delete");


    #AGEBA
    Route::get("/back/ageba", "Admin\XorcisAgebaController@index");
    Route::get("/back/ageba/add", "Admin\XorcisAgebaController@add");

    Route::post("/back/ageba/insert", "Admin\XorcisAgebaController@insert");

    Route::get("/back/xarji", "Admin\DXarjiController@index");
    Route::get("/back/xarji/add", "Admin\DXarjiController@add");

    Route::post("/back/xarji/insert", "Admin\DXarjiController@insert");

});



#ORDER
Route::get("create-order", "OrderController@addOrder");

#MIGEBA
Route::get("/back/migeba", "Admin\MigebaController@index");
Route::get("/back/migeba/product", "Admin\MigebaController@productisMigeba");
Route::get("/back/migeba/ingredienti", "Admin\MigebaController@ingredientisMigeba");
Route::post("/back/migeba/insertIngredienti", "Admin\MigebaController@insertIngredienti");
Route::post("/back/migeba/insertProducti", "Admin\MigebaController@insertProduct");


#NISIA
Route::get("/back/nisia", "Admin\NisiaController@index");
Route::get("/back/nisia/mivige/{nisia_id}", "Admin\NisiaController@mivige");

Route::get("/back/nisia/damateba", "Admin\NisiaController@addNisia");
Route::post("/back/nisia/insertNisia", "Admin\NisiaController@insertNisia");

#ARCHIVE
Route::get("back/archive", "Admin\ArchiveController@index");
Route::get("archivedata", "Admin\ArchiveController@archiveData");

#CHASWOREBA
Route::get("/back/ingredientis-chasworeba/{ingredientis_id}", "Admin\MigebaController@ingredientisChasworeba");
Route::get("/back/productis-chasworeba/{product_id}", "Admin\MigebaController@productisChasworeba");
Route::post("/back/ingredientisChasworeba/{ingredientis_id}", "Admin\MigebaController@ingredientisUpdate");
Route::post("/back/productisChasworeba/{ingredientis_id}", "Admin\MigebaController@productUpdate");

Route::get("sawyobiarchive", "Admin\SawyobisProductController@sawyobiArchive");
Route::get("migebaarchive", "Admin\MigebaController@migebaArchiveIngredienti");

#CANCEL MIGEBA
Route::get("/cancelMigeba/{migeba_id}", "Admin\MigebaController@cancelMigeba");


Route::get("print", "OrderController@print");

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
