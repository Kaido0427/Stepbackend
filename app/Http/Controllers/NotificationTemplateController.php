<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\NotificationTemplate;
use Illuminate\Http\Request;

class NotificationTemplateController extends Controller
{
    public function index()
    {
        $templates = NotificationTemplate::get();
        $notification = NotificationTemplate::first();
        return view('notification_template.notification_template',compact('templates','notification'));
    }

    public function edit_notification($id)
    {
        $notification = NotificationTemplate::find($id);
        return response(['success' => true , 'data' => $notification]);
    }

    public function update_template(Request $request,$id)
    {
        $id = NotificationTemplate::find($id);
        $id->update($request->all());
        return redirect()->back()->withStatus(__('Notification Template update successfully..!!'));
    }
}
