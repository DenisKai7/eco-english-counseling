<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Mentor;
use Auth; // Pastikan Auth di-import

class UserController extends Controller
{
    // ... (metode yang sudah ada dari HomeController jika mau dipisah)

    public function startChat(Mentor $mentor)
    {
        $userId = Auth::id();
        // Buat atau ambil percakapan yang sudah ada
        $messages = Chat::where('user_id', $userId)
                        ->where('mentor_id', $mentor->id)
                        ->orderBy('created_at', 'asc')
                        ->get();
        return view('user.counseling.chat', compact('mentor', 'messages'));
    }

    public function sendMessage(Request $request, Mentor $mentor)
{
    $request->validate([
        'message' => 'required|string',
    ]);

    $chat = Chat::create([
        'user_id' => Auth::id(),
        'mentor_id' => $mentor->id,
        'message' => $request->message,
        'sender_type' => 'user',
    ]);

    event(new \App\Events\NewChatMessage($chat->message, $chat->user_id, $chat->mentor_id, $chat->sender_type));

    return back(); // Tidak perlu with('success') karena realtime
}
}