<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Profile::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'address' => 'required|string',
            'date_of_birth' => 'required|date',
            'partita_iva' => 'required|string',
        ]);
        if (!auth()->user()->profile){
            $p = new Profile();
            $p->user_id = auth()->user()->id;
            $p->address = $request->address;
            $p->bio = $request->bio;
            $p->date_of_birth = $request->date_of_birth;
            $p->partita_iva = $request->partita_iva;
            $p->save();
            return $p;
        } else {
            return ['status' => 'error', 'message' => 'profile is already existing'];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        return auth()->user()->profile;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile, Request $request)
    {
        $this->validate($request, [
            'address' => 'string',
            'date_of_birth' => 'date',
            'partita_iva' => 'string',
        ]);
        if (auth()->user()->profile){
            $p = auth()->user()->profile;
            if ($request->address) {
                $p->address = $request->address;
            }
            if ($request->bio) {
                $p->bio = $request->bio;
            }
            if ($request->date_of_birth) {
                $p->date_of_birth = $request->date_of_birth;
            }
            if ($request->partita_iva) {
                $p->partita_iva = $request->partita_iva;
            }
            $p->save();
            return $p;
        } else {
            return ['status' => 'error', 'message' => 'Profile is not existing, create it!...'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        auth()->user()->profile->delete();
        return ['status' => 'success', 'message' => 'Profile details deleted successfully!'];
    }
}
