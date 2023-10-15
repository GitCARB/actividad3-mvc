<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Category;

class TodosController extends Controller
{
   /**
     * index para mostrar todos los todos
     * store para guardar un todo
     * update para actualizar un todo
     * destroy para eliminar unn todo
     * edit para mostrar el formulario de edicion
     */
    
     public function store(Request $request){

        $request->validate([
            'title'=>'required|min:3'
        ]);

        $todo = new Todo;
        $todo->title = $request->title;
        $todo->category_id = $request->category_id;
        $todo->save();

        return redirect()->route('todos')->with('success','Tarea creada correctamente');
     } 

     public function index(){
         $todos = Todo::all();
         $categories = Category::all();
         return view('todos.index', ['todos' => $todos, 'categories' => $categories]);
     }   

     public function show($id){
      $todos = Todo::find($id);
      return view('todos.show', ['todos' => $todos]);
     }

     public function update(Request $request, $id){
      $todos = Todo::find($id);
      $todos->title = $request->title;
      $todos->save();      

      //return view('todos.index', ['success' => 'Tarea actualizada!']);
      return redirect()->route('todos')->with('success', 'Tarea actualizada!');
     }

     public function destroy($id){
      $todos = Todo::find($id);
      $todos->delete();

      return redirect()->route('todos')->with('success', 'Tarea ha sido eliminada!'); 
  }
} 


