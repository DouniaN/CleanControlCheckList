<?php

namespace App\Http\Controllers\parametre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\categorie;
use App\materiel;
use Validator;


class BiensController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of(materiel::latest()->join('categories', 'categories.id_categorie', '=' ,'materiels.id_categorie') ->select('materiels.*', 'categories.categorie')->get())
                ->addColumn('action2', function($data){
                    $button = '<button type="button" name="editBiens" id="'.$data->id_action.'" class="editBiens btn btn-primary btn-sm">Edit</button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="deleteBiens" id="'.$data->id_action.'" class="deleteBiens btn btn-danger btn-sm">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action2'])
                ->make(true);
        }
        
        $categories = DB::table('categories')->get();
            
          
        return view('CRUD\Action')->with([
                                'categories'  => $categories        
                               ]);
    
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     */
    public function store(Request $request)
    {
        
        $rules = array(
            
            'categorie_Biens'    =>  'required',
            'Biens'              =>  'required'

        );
        
        $error = Validator::make($request->all(), $rules);
        
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        
        
    
        $form_data = array(
            
         'id_categorie'        =>  $request->categorie_Biens,
         'materiel'            =>  $request->Biens,
       
        );
       
        DB::table('materiels')->insert($form_data);
            
        return response()->json(['success' => 'Data Added successfully.']);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('materiels')->where('id_materiel',$id)->delete();
    }
        
}
