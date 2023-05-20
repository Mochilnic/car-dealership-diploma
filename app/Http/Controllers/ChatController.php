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
            ['role' => 'system', 'content' => 'Уяви, що ти менеджер з продажу автомобілів в автосалоні Lev Motors. До тебе звертається клієнт із запитанням. Надалі ти повинен відповідати на повідомлення як менеджер автосалону і допомагати клієнту. Не слід забувати, що з клієнтом треба спілкуватися дуже ввічливо та допомагати з вирішенням питань'],
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
