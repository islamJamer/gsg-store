<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    // CRUD: Create, Read, Update, Delete
    
    // 1. Read Action:
    public function index(){
        // SELECT * from categories
        // Return a collection 
        $title = 'Categories List';
        $categories = Category::all(); 
        // dd($categories);
        // var_dump($categories);
        // dd($categories);

        // $categories= [
        //     'id' => 4,
        //     'name' => 'islam',
        //     'parent_id' => '123'
        // ];

        return view('dashboard.categories.index', compact('title', 'categories'));
    }

    // 2. Delete Action:
    public function destroy($id){
        $category = Category::destroy($id);
        return redirect(route('dashboard.categories.index'));
    }

    // 3. Create Action:
    //   UI Form
    public function create(){
        $categories = Category::all();
        return view('dashboard.categories.create',[
            'parents' => $categories
        ]);
    }

    //   Add to the table
    public function post(Request $request){
        // $categories = Category::create([
        //     'name' => $request->post('name'),
        //     'slug' => Str::slug($request->post('name')),
        //     'parent_id' => $request->post('parent_id'),
        //     'description' => $request->post('description')
        // ]);

        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);
        $categories = Category::create($request->all());

        // PRG: Post redirect get.
        return redirect(route('dashboard.categories.index'));
    }


    // 4. Update Action
    // UI Form
    public function edit($id){
        $category = Category::find($id);
        if(!$category)
            abort('404');

        // $parents = Category::all();
        $parents = Category::where('id', '<>', $id)->get();

        return view('dashboard.categories.edit', compact('category', 'parents'));
    }

    // update table 
    public function update(Request $request, $id){
        // $request->merge([
        //     'slug' => Str::slug($request->post('name'))
        // ]);
        $category = Category::where('id', '=', $id)->update($request->except(['_token', '_method']));

        return redirect(route('dashboard.categories.index'));
    }

}
