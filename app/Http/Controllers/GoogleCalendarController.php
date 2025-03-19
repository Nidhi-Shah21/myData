<?php

namespace App\Http\Controllers;

use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Google_Service_Calendar_EventDateTime;
class GoogleCalendarController extends Controller
{
    public function redirectToGoogle()
    {
        $client = new Google_Client();
        $client->setClientId(config('google.client_id'));
        $client->setClientSecret(config('google.client_secret'));
        $client->setRedirectUri(config('google.redirect_uri'));
        $client->setScopes(config('google.scopes'));
        $client->setAccessType('offline');

        return redirect($client->createAuthUrl());
    }

    public function handleGoogleCallback(Request $request)
    {
        $client = new Google_Client();
        $client->setClientId(config('google.client_id'));
        $client->setClientSecret(config('google.client_secret'));
        $client->setRedirectUri(config('google.redirect_uri'));
        $client->setScopes(config('google.scopes'));
        $client->setAccessType('offline');

        $token = $client->fetchAccessTokenWithAuthCode($request->code);
        Session::put('google_token', $token);

        return redirect()->route('addEvent');
    }

    public function addEvent()
    {
        $client = new Google_Client();
        $client->setClientId(config('google.client_id'));
        $client->setClientSecret(config('google.client_secret'));
        $client->setRedirectUri(config('google.redirect_uri'));
        $client->setScopes(config('google.scopes'));
        $client->setAccessType('offline');

        if (Session::has('google_token')) {
            $client->setAccessToken(Session::get('google_token'));

            $service = new Google_Service_Calendar($client);
            $event = new Google_Service_Calendar_Event([
                'summary' => 'Test nidhi Event',
                'location' => 'Online',
                'description' => 'A test event added via API',
                'start' => ['dateTime' => '2025-03-18T10:00:00', 'timeZone' => 'Australia/Melbourne'],
                'end' => ['dateTime' => '2025-03-18T11:00:00', 'timeZone' => 'Australia/Melbourne'],
                'reminders' => ['useDefault' => TRUE],
            ]);
            // $calendarId = 'c_681714dcf422f44e53c35750a15aa3a11d130720e70fdde8f37f265ed676aca7@group.calendar.google.com';
            $calendarId = 'primary';
            $service->events->insert($calendarId, $event);

            return "Event added to Google Calendar!";
        }

        return redirect()->route('google.redirect');
    }
    public function listEvents()
    {
        $client = new Google_Client();
        $client->setClientId(config('google.client_id'));
        $client->setClientSecret(config('google.client_secret'));
        $client->setRedirectUri(config('google.redirect_uri'));
        $client->setScopes(config('google.scopes'));
        $client->setAccessType('offline');

        if (Session::has('google_token')) {
            $client->setAccessToken(Session::get('google_token'));

            if ($client->isAccessTokenExpired()) {
                // Refresh the token if expired
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                Session::put('google_token', $client->getAccessToken());
            }

            $service = new Google_Service_Calendar($client);
            $calendarId = 'primary';

            // Get the upcoming events
            $events = $service->events->listEvents($calendarId, [
                'maxResults' => 10, // Fetch 10 events
                'orderBy' => 'startTime',
                'singleEvents' => true,
                'timeMin' => date('c'), // Get events from the current time onward
            ]);

            $eventList = [];
            foreach ($events->getItems() as $event) {
                $eventList[] = [
                    'eventId' => $event->getId(),
                    'summary' => $event->getSummary(),
                    'start' => $event->getStart()->getDateTime() ?: $event->getStart()->getDate(),
                    'end' => $event->getEnd()->getDateTime() ?: $event->getEnd()->getDate(),
                ];
            }

            return response()->json($eventList);
        }

        return redirect()->route('google.redirect');
    }
    public function deleteEvent($eventId)
    {
        $client = new Google_Client();
        $client->setClientId(config('google.client_id'));
        $client->setClientSecret(config('google.client_secret'));
        $client->setRedirectUri(config('google.redirect_uri'));
        $client->setScopes(config('google.scopes'));
        $client->setAccessType('offline');

        if (Session::has('google_token')) {
            $client->setAccessToken(Session::get('google_token'));

            if ($client->isAccessTokenExpired()) {
                // Refresh the token if expired
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                Session::put('google_token', $client->getAccessToken());
            }

            $service = new Google_Service_Calendar($client);
            $calendarId = 'primary';

            try {
                $service->events->delete($calendarId, $eventId);
                return response()->json(['message' => 'Event deleted successfully']);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Event not found or already deleted'], 404);
            }
        }

        return redirect()->route('google.redirect');
    }

    public function updateEvent($eventId)
    {
        $client = new Google_Client();
        $client->setClientId(config('google.client_id'));
        $client->setClientSecret(config('google.client_secret'));
        $client->setRedirectUri(config('google.redirect_uri'));
        $client->setScopes(config('google.scopes'));
        $client->setAccessType('offline');

        if (Session::has('google_token')) {
            $client->setAccessToken(Session::get('google_token'));

            if ($client->isAccessTokenExpired()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                Session::put('google_token', $client->getAccessToken());
            }

            $service = new Google_Service_Calendar($client);
            $calendarId = 'primary';

            try {
                // Get the event by eventId
                $event = $service->events->get($calendarId, $eventId);

                // Update with static values
                $event->setSummary('Updated Nidhi Event Title');
                $event->setLocation('Melbourne, Australia');
                $event->setDescription('This event was updated using static values.');

                $event->setStart(new Google_Service_Calendar_EventDateTime([
                    'dateTime' => '2025-03-20T10:00:00',
                    'timeZone' => 'Australia/Melbourne'
                ]));

                $event->setEnd(new Google_Service_Calendar_EventDateTime([
                    'dateTime' => '2025-03-20T11:00:00',
                    'timeZone' => 'Australia/Melbourne'
                ]));

                // Save the updated event
                $updatedEvent = $service->events->update($calendarId, $eventId, $event);

                return response()->json(['message' => 'Event updated successfully', 'event' => $updatedEvent]);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Event not found or update failed', 'details' => $e->getMessage()], 404);
            }
        }

        return redirect()->route('google.redirect');
    }



}
