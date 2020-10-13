<?php

namespace App\Http\Controllers;

use App\Models\Scheduler;
use Illuminate\Http\Request;
use Auth;
use App\Rules\LessTodayValidate;

class SchedulerController extends Controller
{
    /**
     * Default page configs
     *
     * @var array
     */
    protected $pageConfigs = [
        'navbarType' => 'sticky',
        'footerType' => 'static',
        'horizontalMenuType' => 'floating',
        'theme' => 'dark',
        'navbarColor' => 'bg-primary'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedulers = Auth::user()->schedulers;

        return view('/pages/schedulers/index', [
            'pageConfigs' => $this->pageConfigs,
            'schedulers' => $schedulers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/pages/schedulers/create', [
            'pageConfigs' => $this->pageConfigs
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'title' => 'required|string|max:190',
            'description' => 'required|string|max:190',
            'schedule' => ['required', 'string', 'max:190', new LessTodayValidate]
        ]);

        Auth::user()->schedulers()->create([
            'title' => $request->title,
            'description' => $request->description,
            'schedule' => $request->schedule
        ]);

        return redirect('/schedulers')
            ->with('message', trans('locale.scheduler.message.save'));
    }

    /**
     * Store schedule by specified post
     */
    public function storeByPost(\App\Models\Post $post, Request $request)
    {
        $post->schedule()->updateOrCreate(['post_id' => $post->id], [
            'title' => $request->title,
            'description' => $request->description,
            'schedule' => $request->schedule,
            'user_id' => Auth::user()->id
        ]);

        return redirect('/myposts')
            ->with('message', trans('locale.scheduler.message.save'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Scheduler  $scheduler
     * @return \Illuminate\Http\Response
     */
    public function show(Scheduler $scheduler)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Scheduler  $scheduler
     * @return \Illuminate\Http\Response
     */
    public function edit(Scheduler $scheduler)
    {
        return view('/pages/schedulers/edit', [
            'pageConfigs' => $this->pageConfigs,
            'scheduler' => $scheduler
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Scheduler  $scheduler
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Scheduler $scheduler)
    {
        $validator = $request->validate([
            'title' => 'required|string|max:190',
            'description' => 'required|string|max:190',
            'schedule' => ['required', 'string', 'max:190', new LessTodayValidate]
        ]);

        $scheduler->update([
            'title' => $request->title,
            'description' => $request->description,
            'schedule' => $request->schedule
        ]);

        return redirect('/schedulers')
            ->with('message', trans('locale.scheduler.message.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Scheduler  $scheduler
     * @return \Illuminate\Http\Response
     */
    public function destroy(Scheduler $scheduler)
    {
        $scheduler->delete();

        return redirect('/schedulers')
            ->with('message', trans('locale.scheduler.message.delete'));
    }
}
