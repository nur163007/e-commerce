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

Route::get('/','SiteController@index')->name('index');
Route::get('/product','SiteController@product')->name('product');

Auth::routes();


Route::middleware(['auth'])->group(function(){


Route::get('/home', 'HomeController@index')->name('home');


// brand routes

Route::get('/brand/add-brand', 'BrandController@addBrand')->name('add.brand');
Route::get('/brand/manage-brand', 'BrandController@manageBrand')->name('manage.brand');
Route::post('/brand/save-brand', 'BrandController@saveBrand')->name('save.brand');
// Route::get('/brand/inactive-brand/{id}', 'BrandController@inactiveBrand')->name('inactive.brand');
// Route::get('/brand/active-brand/{id}', 'BrandController@activeBrand')->name('active.brand');
Route::get('/brand/delete-brand/{id}', 'BrandController@deleteBrand')->name('delete.brand');
Route::get('/brand/edit-brand/{id}', 'BrandController@editBrand')->name('edit.brand');
Route::post('/brand/update-brand', 'BrandController@updateBrand')->name('update.brand');

Route::get('/brand/brandStatus/{id}/{status}', 'BrandController@brandStatus')->name('brandStatus');

// categories route

Route::get('/categories/manage-category', 'CategoryController@manageCategory')->name('manage.category');
Route::get('/categories/add-category', 'CategoryController@addCategory')->name('add.category');
Route::post('/categories/save-category', 'CategoryController@saveCategory')->name('save.category');
Route::get('/categories/categoryStatus/{id}/{status}', 'CategoryController@categoryStatus')->name('categoryStatus');
Route::get('/categories/delete-category/{id}', 'CategoryController@deleteCategory')->name('delete.category');
Route::get('/categories/edit-category/{id}', 'CategoryController@editCategory')->name('edit.category');
Route::post('/categories/update-category', 'CategoryController@updateCategory')->name('update.category');

// sub categories route
Route::get('/categories/manage-sub-category', 'SubCategoryController@manageSubCategory')->name('manage.subCategory');
Route::get('/categories/add-subcategory', 'SubCategoryController@addSubCategory')->name('add.subcategory');
Route::post('/categories/save-subcategory', 'SubCategoryController@saveSubcategory')->name('save.subcategory');
Route::get('/categories/delete-subcategory/{id}', 'SubCategoryController@deleteSub')->name('delete.subcategory');
Route::get('/categories/subcategoryStatus/{id}/{status}', 'SubCategoryController@subStatus')->name('subStatus');
Route::get('/categories/edit-subcategory/{id}', 'SubCategoryController@editSub')->name('edit.subcategory');
Route::post('/categories/update-subcategory', 'SubCategoryController@updateSub')->name('update.subcategory');

// SUB SUB CATEGORIES ROUTE
Route::get('/categories/manage-sub-sub-category', 'SubSubController@manageSubSubCategory')->name('manage.subSubCategory');
Route::get('/categories/add-sub-sub-category', 'SubSubController@addSubSubCategory')->name('add.subSubCat');
Route::post('/categories/save-sub-sub-category', 'SubSubController@saveSubSubCategory')->name('save.subSubCat');
Route::get('/categories/sub-sub-category/loadSubCat/', 'SubSubController@loadSubCat')->name('load.subSubCat');
Route::get('/categories/subsubcategoryStatus/{id}/{status}', 'SubSubController@subSubStatus')->name('subSubStatus');
Route::get('/categories/delete-sub-sub-category/{id}', 'SubSubController@deleteSubSub')->name('delete.subSubCat');
Route::get('/categories/edit-sub-sub-category/{id}', 'SubSubController@editSubSub')->name('edit.subSubCat');
Route::post('/categories/update-sub-sub-category', 'SubSubController@updateSubSub')->name('update.subSubCat');

});