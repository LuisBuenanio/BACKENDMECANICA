<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\User;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Perfil::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $perfil = new Perfil();
        $perfil->user_id = $user->id;
        $perfil->nombre = $request->nombre;
        $perfil->save();
        return $perfil;
    }

    /**
     * Display the specified resource.
     */
    public function show(Perfil $perfil)
    {
        $perfil->chat_perfils = $this->chatPerfils($perfil);
        
        
        return $perfil;
    }
    public function chatPerfils(Perfil $perfil)
    {
        $chat_perfils = $perfil->ChatPerfils()->with(['Chat'])->get();
        $lista = [];
        foreach($chat_perfils as $c){
            $chat = $c->chat;
            $propietarios = $chat->ChatPerfils()->where('perfil_id','!=',$perfil->id)->get();
            if($propietarios->count()>0){
                $c->destino = $propietarios->first();
                $c->destino->perfil = $c->destino->Perfil;
                $c->destino->letra= strtoupper(substr($c->destino->Perfil->nombre,0,1));
                $c->letra= strtoupper(substr($perfil->nombre,0,1));
            }
            
            $c->mensajes = $this->mensajes($chat);
            /*$c->ultimo = $c->mensajes->count()>0?[$c->mensajes->first()]:[];
            $c->sinLeer = $this->mensajesSinLeer($chat,$c->id);
            $c->order_id = $c->created_at;
            if($c->mensajes->count()>0){
                $item = $c->mensajes->first();
                $c->order_id = $item->created_at;
            }
            $this->recibirMensajes($chat,$c->id); */
            $lista[] = $c;
        }
        // $perfil->chat_perfils = collect($lista)->sortBy('order','desc');
        $chat_perfils = collect($lista)->sortByDesc('order_id');
        $lista_2 = [];
        foreach($chat_perfils as $chat){
            $lista_2[] = $chat;
        }
        return $lista_2;
    }
    public function mensajes(Chat $chat)
    {
        $mensajes =$chat->Mensajes()->orderBy('id','desc')->take(10)->get();
        foreach($mensajes as $m){
                        
            $m->leido = $m->Leidos()->get()->count();
            $m->recibido = $m->Recibidos()->get()->count();
            $m->hora = $m->created_at->format("h:i a");
        }
        return $mensajes;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Perfil $perfil)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}
