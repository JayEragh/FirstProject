<?php

namespace App\Http\Controllers;

use App\Mail\RecentDocumentsMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Show the email dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::count();
        $recentDocuments = \App\Models\Document::with('user')
            ->where('created_at', '>=', now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->get();

        return view('emails.index', compact('users', 'recentDocuments'));
    }

    /**
     * Send recent documents to all users.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendRecentDocuments()
    {
        $users = User::all();
        $recentDocuments = \App\Models\Document::with('user')
            ->where('created_at', '>=', now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->get();

        $sentCount = 0;
        $failedCount = 0;

        foreach ($users as $user) {
            try {
                Mail::to($user->email)->send(new RecentDocumentsMail($user, $recentDocuments));
                $sentCount++;
            } catch (\Exception $e) {
                $failedCount++;
            }
        }

        return redirect()->route('emails.index')->with('success', "Emails sent successfully! Sent: {$sentCount}, Failed: {$failedCount}");
    }

    /**
     * Send recent documents to specific user.
     *
     * @param  int  $userId
     * @return \Illuminate\Http\Response
     */
    public function sendToUser($userId)
    {
        $user = User::findOrFail($userId);
        $recentDocuments = \App\Models\Document::with('user')
            ->where('created_at', '>=', now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->get();

        try {
            Mail::to($user->email)->send(new RecentDocumentsMail($user, $recentDocuments));
            return redirect()->route('emails.index')->with('success', "Email sent successfully to {$user->email}!");
        } catch (\Exception $e) {
            return redirect()->route('emails.index')->with('error', "Failed to send email to {$user->email}!");
        }
    }
}
