<?php

namespace App\Http\Controllers\rapports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\division;
use App\etat;
use App\categorie;
use App\materiel;
use App\action;
use App\action_materiel;
use App\action_check;
use Illuminate\Support\MessageBag;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Support\Facades\Validator;

class ChartDataController extends Controller
{
    function index(){
        
      return view('rapports/index');
      
    }
    
    /**
        
    **/
    function getChecks(Request $request){
        
        $valueSession     = $request->session()->get('dataSession');
        $divisions        = division::all();
        $etats            = etat::all();
        $categories       = categorie::all();
        $actions          = action::all();
      
             
        $checks = DB::table('checks')
        ->join('categories'      , 'checks.id_categorie'        ,  '=', 'categories.id_categorie')
        ->join('divisions'       , 'checks.id_division'         ,  '=', 'divisions.id_division')
        ->join('materiels'       , 'checks.id_materiel'         ,  '=', 'materiels.id_materiel')
        ->join('etats'           , 'checks.id_etat'             ,  '=', 'etats.id_etat')
        ->join('remarques'       , 'checks.id_remarque'         ,  '=', 'remarques.id_remarque')
        ->join('action_checks'   , 'action_checks.id_check'     ,  '=', 'checks.id')
        ->select('checks.*', 'divisions.division','categories.categorie','materiels.materiel','etats.etat','remarques.remarque','action_checks.Date_action_operateur')
        ->distinct()
        ->get();
            
        
        return view('rapports/Checks')->with([
            
            'divisions'        =>$divisions,
            'etats'            =>$etats,
            'categories'       =>$categories,
            'checks'           =>$checks,
            'actions'          =>$actions
           
        ]); 
        
    }
    
    function getActionsChecks(Request $request){
        
        $id_check         = $request->get('id_check');
        $actions_check    = action_check::all();
        $actions          = action::all();
        
        $actionsChecks    = DB::table('action_checks')
        ->join('actions'         , 'action_checks.id_action', '=', 'actions.id_action')
        ->select('action_checks.*', 'actions.action')
        ->where('action_checks.id_check',$id_check)
        ->get();
        return $actionsChecks;
        
    }
  
    
}
