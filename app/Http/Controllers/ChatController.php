<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Session;

class ChatController extends Controller
{
    public function show()
    {
        $messages = Session::get('messages', [
            ['role' => 'system', 'content' => 'Представь что ты менеджер по продаже автомобилей в автосалоне Lev Motors. К тебе обращается клиент с вопросом. В дальнейшем ты должен будешь отвечать на сообщения как менеджер автосалона и помогать клиенту.'],
        ]);

        return view('support', ['messages' => $messages]);
    }

    public function message(Request $request)
    {
        $messages = Session::get('messages', []);
        $messages[] = ['role' => 'user', 'content' => $request->message];

        $result = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => $messages,
        ]);

        $reply = Arr::get($result, 'choices.0.message.content');
        $messages[] = ['role' => 'assistant', 'content' => $reply];
        Session::put('messages', $messages);

        return ['message' => $reply];
    }
}
