<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function getIndex()
    {
        return view('Contact');
    }
    public function getData()
    {
        return Contact::all();
    }
    public function postStore(Request $r)
    {
        Contact::create($r->all());
        return ['success'=>true,'message'=>'Inserted Successfully'];
    }
    public function postUpdate(Request $r)
    {
        if($r->has('id')){
            Contact::find($r->input('id'))->update($r->all());
            return ['success'=>true,'message'=>'Updated Successfully'];
        }
    }
    public function postDelete(Request $r)
    {
        if($r->has('id')){
            Contact::find($r->input('id'))->delete();
            return ['success'=>true,'message'=>'Deleted Successfully'];
        }
    }
}
