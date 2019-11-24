<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ThreadMessage;
use App\Models\Thread;
use App\Models\User;

class MessageController extends Controller {

    public function composeNewMessage(Request $request) {

        $rules = [
            'new-message-recipient' => 'required',
            'new-message-content' => 'required',
        ];

        $messages = [
            'new-message-recipient.required' => 'You didn\'t state the recipient.',
            'new-message-content.required' => 'You didn\'t type anything.'
        ];

        $request->validate($rules, $messages);

        try {
            $thread = new Thread;
            $threadMessage = new ThreadMessage;

            $thread_from = session()->get('user')[0]->username;
            $thread_to = $request->get('new-message-recipient');
            $viewer = '0';

            $text = $request->get('new-message-content');

            $user = new User();

            $userToSend = $user->getUserToSend($thread_to);

            if( $userToSend !== null && $thread_from === $userToSend->username ) {
                return redirect()->back()->with('error', 'You cannot send message to yourself.');
            } else if ( $userToSend !== null && $thread_from !== $userToSend->username ) {
                $thread_to = $userToSend->username;
            } else {
                return redirect()->back()->with('error', 'There is no registered user with that username or e-mail.');
            }

            $thisThread = $thread->getThisThread($thread_from, $thread_to);

            if ( $thisThread === null ) {
                $threadID = $thread->createThread($thread_from, $thread_to, $viewer);
                $threadMessage->sendMessage($text, $threadID, $thread_from);

                return redirect()->back()->with('success', 'Message sent.');
            } else {
                $thisThreadID = $thisThread->id;

                $thread->updateThread($thisThreadID, $viewer);
                $threadMessage->sendMessage($text, $thisThreadID, $thread_from);

                return redirect()->back()->with('success', 'Message sent.');
            }
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return redirect('/')->with('error', $ex->getMessage());
        }
    }

    public function replyMessage($threadID, Request $request) {

        $viewer = $request->get('viewer');

        $text  = $request->get('text');
        $sender = $request->get('sender');

        try {
            $thread = new Thread();
            $threadMessage = new ThreadMessage();

            $thread->updateThread($threadID, $viewer);
            $threadMessage->sendMessage($text, $threadID, $sender);

            return response(200);
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return response('Oops, there\'s been an error. Please, try again.', 500);
        }
    }

    public function deleteMessage($threadID) {

        try{
            $thread = new Thread();
            $threadMessage = new ThreadMessage();

            $myUsername = session()->get('user')[0]->username;

            $thread_from = $thread->getThreadToDelete($threadID)->thread_from;
            $thread_to = $thread->getThreadToDelete($threadID)->thread_to;
            $viewer = $thread->getThreadToDelete($threadID)->viewer;

            if ( $myUsername === $thread_from ) {
                $newViewer = $thread_to;
            } else {
                $newViewer = $thread_from;
            }

            if ( $viewer === '0') {
                $thread->deleteMyThread($threadID, $newViewer);
            } elseif ( $viewer = $myUsername ) {
                $thread->deleteThread($threadID);
                $threadMessage->deleteThreadMessages($threadID);
            }

            return redirect()->back()->with('success', 'Message deleted.');

        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return redirect('/')->with('error', 'Oops, there\'s been an error. Please, try again.');
        }
    }

    public function sendMessage($username, Request $request) {

        $rules = [
            'messageContent' => 'required',
        ];

        $messages = [
            'required' => 'You didn\'t type anything.',
        ];

        $request->validate($rules, $messages);

        $thread_from = session()->get('user')[0]->username;
        $thread_to = $username;
        $viewer = '0';

        $text = $request->get('messageContent');

        try {
            $thread = new Thread();
            $threadMessage = new ThreadMessage();

            $thisThread = $thread->getThisThread($thread_from, $thread_to);

            if ( $thisThread === null ) {
                $threadID = $thread->createThread($thread_from, $thread_to, $viewer);
                $threadMessage->sendMessage($text, $threadID, $thread_from);

                return redirect()->back()->with('success', 'Message sent.');
            } else {
                $thisThreadID = $thisThread->id;

                $thread->updateThread($thisThreadID, $viewer);
                $threadMessage->sendMessage($text, $thisThreadID, $thread_from);

                return redirect()->back()->with('success', 'Message sent.');
            }
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return redirect('/')->with('error', $ex->getMessage());
        }
    }
}
