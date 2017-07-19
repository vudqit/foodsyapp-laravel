<?php

namespace App\Http\Controllers;

use App\Event; 
use App\User; 
use App\Place;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class EventController extends ApiController
{
    private $event; 

    public function __construct(Event $event) 
    {
        $this->event = $event; 
    }

    public function getAvailableEvents() 
    {
        $events = $this->event->where('status', Event::AVAILABLE)->get(); 

        foreach ($events as $event) {
            $event->place_name = $event->place->display_name; 
            unset($event->place);
        }
        
        return $this->listResponse($events); 
    }

    public function getPendingEvents(Request $request) 
    {
        $user = $this->getAuthUser($request->token); 
        if ($user->role != User::ROLE_ADMIN) {
            return $this->insufficientPrivilegesResponse('You must be admin to do this action');
        }

        $events = $this->event->where('status', Event::PENDING)->get(); 

        return $this->listResponse($events); 
    }

    public function store(Request $request) 
    {
        $rule = [
            'title'     => 'required', 
            'place_id'  => 'required'
        ];

        $this->validate($request, $rule); 

        $photo = null; 
        if ($request->photo) {
            $photo = $request->photo->store('');
        }

        $event = $this->event->create([
            'title' => $request->title,
            'content' => $request->content,   
            'photo' => $photo, 
            'sale' => $request->sale, 
            'time_start' => $request->time_start, 
            'time_end' => $request->time_end, 
            'place_id' => $request->place_id,
        ]);

        return $this->showResponse($event);
    }

    public function update(Request $request)
    {
        $this->checkUserHasOwnerPermission($request->token);

        $event = $this->event->findOrFail($request->id); 

        $event->fill($request->intersect([
            'title',
            'content',   
            'photo', 
            'sale', 
            'time_start', 
            'time_end',
        ]));

        if ($event->isClean()) {
            return $this->notUpdatedResponse('You need to specify different field to update!');
        }

        $rules = [
            'photo' => 'image'
        ]; 

        $this->validate($request, $rules);

        if ($request->photo) {
            $event->photo = $request->photo->store('');
        } 
        
        $event->save(); 

        return $this->showResponse($event);
    }

    public function getPhoto($id) 
    {
        $event = $this->event->findOrFail($id); 

        if (!Storage::exists($event->photo)) {
            return $this->notAcceptQueryResponse('Image not found!'); 
        }

        $file = Storage::get($event->photo);
        $type = Storage::mimeType($event->photo);

        $response = Response::make($file, 200);
        $response->header('Content-Type', $type);

        return $response;
    }
    
}
