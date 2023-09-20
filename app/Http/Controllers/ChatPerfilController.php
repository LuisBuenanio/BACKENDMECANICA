<?php

namespace App\Http\Controllers;

use App\Models\ChatPerfil;
use Illuminate\Http\Request;

class ChatPerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ChatPerfil::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ChatPerfil $chatPerfil)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ChatPerfil $chatPerfil)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChatPerfil $chatPerfil)
    {
        //
    }
}
