<?php

namespace App\Http\Controllers;

use App\Subscription;
use App\SubscriptionBuy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptions = Subscription::with('owner')->get();
        return view('subscription.index', compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subscription.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'subscription_name' => 'bail|required|max:255',
        ]);

        // Ne récupérez pas les données de tarification
        $data = $request->only(['subscription_name']);

        // Créez un plan vide (gratuit)
        $plan = [];

        // Encodez le plan vide en JSON
        $data['plan'] = json_encode($plan);

        // Créez la souscription
        Subscription::create($data);

        // Redirigez l'utilisateur
        return redirect('subscription')->withStatus(__('Subscription created successfully..!!'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subscription = Subscription::find($id);
        $subscription->plan = json_decode($subscription->plan);
        return view('subscription.edit', compact('subscription'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'subscription_name' => 'bail|required|max:255',
        ]);

        // Ne récupérez pas les données de tarification
        $data = $request->only(['subscription_name']);

        // Créez un plan vide (gratuit)
        $plan = [];

        // Encodez le plan vide en JSON
        $data['plan'] = json_encode($plan);

        // Mettez à jour la souscription
        Subscription::where('id', $id)->update($data);

        // Redirigez l'utilisateur
        return redirect('subscription')->withStatus(__('Subscription updated successfully..!!'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Subscription::find($id)->delete();
        return redirect('subscription')->withStatus(__('subscription deleted successfully..!!'));
    }

    public function subscriptionHistory()
    {
        $subscriptions = SubscriptionBuy::with(['subscription', 'Owner'])->orderBy('id', 'desc')->get();
        return view('subscription.subscription_history', compact('subscriptions'));
    }
}
