<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class ChatGPTController extends Controller
{

    protected $chatGPT;

    public function __construct()
    {
        $this->chatGPT = app('ChatGPT');
    }

    public function getModels()
    {
        $response = $this->chatGPT->getModels();

        return response()->json([
            'status' => 'success',
            'response' => $response,
        ]);
    }

    public function sendToChatGPT(Request $request)
    {

        $request->validate([
            'prompt' => 'required|string|max:5000',
        ]);

        $prompt = $request->input('prompt');

        $response = $this->chatGPT->generateText($prompt);

        return response()->json([
            'status' => 'success',
            'response' => $response,
        ]);
    }

    public function translateUniqueInput(Request $request)
    {

        $request->validate([
            'prompt' => 'required|string|max:5000',
        ]);

        $prompt = $request->input('prompt');

        $language = $request->input('language');

        $prompt = "Translate this text to {$language}: {$prompt}. Give me only the translated value.";

        $response = $this->chatGPT->generateText($prompt);

        return response()->json([
            'status' => 'success',
            'response' => $response,
        ]);
    }

    public function getCurrentField(Request $request)
    {
        $validated = $request->validate([
            'inputs' => 'required|array',
            'currentLang' => 'required|string|size:2',
        ]);

        $translatedInputs = array_map(function ($input) use ($validated) {
            $input['name'] = $this->updateFieldName($input['name'], $validated['currentLang']);

            $input['value'] = $this->translateText($input['value'], $validated['currentLang']);

            return $input;
        }, $validated['inputs']);

        return response()->json(['translatedInputs' => $translatedInputs]);
    }

    private function updateFieldName($name, $currentLang)
    {
        $nameParts = explode('[', $name);
        $nameParts[1] = rtrim($nameParts[1], ']');
        $nameParts[1] = $currentLang;
        return implode('[', $nameParts) . ']';
    }

    private function translateText($text, $currentLang)
    {
        $prompt = "Translate this text to {$currentLang}: {$text}. Give me only the translated value.";
        return $this->chatGPT->generateText($prompt);
    }
}
