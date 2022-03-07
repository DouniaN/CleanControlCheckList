<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use User;
use role;


/**
 * Class order
 *
 * @package Controllers
 * @subpackage Class
 * @version 0.1
 * @author Nougaoui Dounia 
 * @Copyright Province de BERKANE
 */
class AuthentificationController extends Controller
{

    function index(){
        return view ('auth/authentification/login');

    }
    

    /**
     * Recuperation des informations d'un utilisateur et les mettre dans une session
     * Verefication des informations d'un user et Authentifier
     * @access public
     * @param  $request 
     *            
     */
    
    function checklogin(Request $request)
    {
        
        $this->validate($request, [
         'email'     => 'required|email',
         'password'  => 'required|alphaNum|min:3'
        ]);
   
        $user_data = array(
         'email'    => $request->email,
         'password' => $request->password    /*Hash::make($request->input('password')*/
        );
        
        

        $users   = DB::table('users')->where('email', '=', $request->email)->get();
        $id_role = $users[0]->id_role;
        
        $dataSession=array(
           'email' => $request->input('email'),
           'role'  => $users[0]->id_role,
           'name'  => $users[0]->name
            
        );
      
        /**
           *attempt() : Method used to  find the user in database table
           *Params: array 
        **/
        
        if(Auth::attempt($user_data)) 
        {
            
            $request->session()->put('dataSession', $dataSession);
            
            if($id_role==1){
              return redirect('index');
            }
            
            if($id_role==2){
                return redirect('getChecks');
            }
            
            if($id_role==3){
                return redirect('getChecksAction');
            }
            if($id_role==4){
                return redirect('Employé');
            }
          
        }
     
        
        else
        {
          return back()->with('error', 'Login ou mot de passe incorrecte');
        }

    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        Session()->forget('dataSession');
        return view('auth/authentification/login');
    }
    
    
}
