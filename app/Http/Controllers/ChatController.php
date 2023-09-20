<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatPerfil;
use App\Models\Mensaje;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return chat::All();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::where('email',$request->email)->get();
        if($user->count()>0){
            $user = $user->first();
            $chat = new Chat();
            $chat->tipo =1;
            $chat->save();

            $user->perfil = $user->Perfil;

            $chatPerfil1 = new ChatPerfil();
            $chatPerfil1->perfil_id = $user->perfil->id;
            $chatPerfil1->chat_id = $chat->id;
            $chatPerfil1->save();

            $chatPerfil2 = new ChatPerfil();
            $chatPerfil2->perfil_id = $request->perfil_id;
            $chatPerfil2->chat_id = $chat->id;
            $chatPerfil2->save();

            $mensaje = new Mensaje();
            $mensaje->chat_perfil_id = $chatPerfil2->id;
            $mensaje->mensaje = $request->mensaje;
            $mensaje->chat_id = $chat->id;
            $mensaje->save();
            return $chat;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chat $chat)
    {
        //
    }
}
