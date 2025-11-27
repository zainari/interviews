<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    protected $flaskBase = 'http://127.0.0.1:5000'; // change if flask runs on other host/port

    public function index()
    {
        return view('chatbot');
    }

    public function create(){
        return view('admin.chatbot.create');
    }

    public function store(Request $request){
        
        $request->validate([
            'flask_url' => 'required|url'
        ]);
        
        $this->flaskBase = rtrim($request->input('flask_url'), '/');

        return redirect()->back()->with('success', 'Flask URL updated successfully.');

    }

    public function send(Request $request)
    {
        $request->validate(['message' => 'required|string']);

        try {
            $resp = Http::timeout(10)->post($this->flaskBase . '/chat', [
                'message' => $request->input('message')
            ]);

            if ($resp->successful()) {
                return response()->json($resp->json());
            }

            // If flask returned non-200
            return response()->json([
                'success' => false,
                'error' => 'Flask returned non-200',
                'status' => $resp->status(),
                'body' => $resp->body()
            ], 500);
        } catch (\Exception $e) {
            Log::error('Chatbot proxy error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Could not reach Flask server',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    // optional train proxy
    public function train(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string'
        ]);

        try {
            $resp = Http::post($this->flaskBase . '/train', $request->only('question', 'answer'));
            return response()->json($resp->json(), $resp->status());
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
