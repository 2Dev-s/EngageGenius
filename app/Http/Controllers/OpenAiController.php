<?php

namespace App\Http\Controllers;

use App\Models\Campain;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class OpenAiController extends Controller
{
    //
    private $chatModel = "gpt-3.5-turbo-0125";

    protected $basePromptChat = [
        'role' => 'system',
        'content' => 'You will act as a content generator, for post and campains on social media you will only give reponses"',
    ];

    /*
        * This function create a post desciption based on the information provided
    */
    public function createPostDescription(Request $request) {
        $postTitle = $request->input('postTitle');
        $postData = $request->input('postData');
        $postOldDesciption = $request->input('postOldDesciption');

        if (!$postTitle) { return response()->json(['error' => 'Post Title is required']);}

        $messageBlock = [
            $this->basePromptChat,
            ['role' => 'user', 'content' => "PostTitle: [" . $postTitle . "]"]
        ];

        if ($postData) {
            $messageBlock[] = ['role' => 'user', 'content' => "PostData: [" . $postData . "]"];
        }

        if ($postOldDesciption) {
            $messageBlock[] = ['role' => 'user', 'content' => "PostOldDesciption: [" . $postOldDesciption . "]"];
        }

        $messageBlock[] = ['role' => 'system', 'content' => 'Use what is anvailable to you, Write a catchy caption / decriptions for the post. No tags.'];

        $result = OpenAI::chat()->create([
            'model' => $this->chatModel,
            'messages' => $messageBlock
        ]);

        return response()->json($result->choices[0]->message->content);
    }
    /*
        * This function create a post for a campain based on the information provided
    */
    public function createPostFromCampain(Campain $campain) {
        $tamplate = $campain->tamplate;

        $result = OpenAI::chat()->create([
            'model' => $this->chatModel,
            'messages' => [
                $this->basePromptChat,
                ['role' => 'user', 'content' => "CampainTitle: [" . $campain->title ."]"],
                ['role' => 'user', 'content' => "CampainDescription: [" .$campain->description ."]"],
                ['role' => 'user', 'content' => "CampainNiche: [" .$campain->niche ."]" ],
                ['role' => 'user', 'content' => "CampainProductFeatures: [" .$campain->product_features ."]"],
                ['role' => 'user', 'content' => "CampainProductDescription: [" .$campain->product_description ."]"],
                ['role' => 'user', 'content' => "Use this tamplate when craeting the post: \n ". $tamplate->prompt ."\n\n end of tamplate"],
                ['role' => 'system', 'content' => 'Genretea a post for the campain. in this fromat [PostTitle: [REponce GEnerated] PostDescription: [REponce GEnerated] no HAsh Tags']
            ],
        ]);

        return $result->choices[0]->message->content;
    }
    /*
        * This function create tags for a post based on the information provided
    */
    public function createPostTags() {
        $result = OpenAI::chat()->create([
            'model' => $this->chatModel,
            'messages' => [
                $this->basePromptChat,
                ['role' => 'user', 'content' => "PostTitle: [Craving for some delicious meat?]"],
                ['role' => 'user', 'content' => "PostDescription: [Indulge in the best Wagyu beef from Japan at our food court sale! Get a mouthwatering 50% off on all meat items for a limited time only. Hurry, your taste buds will thank you!]"],
                ['role' => 'user', 'content' => "Create Tags for post base on the inforation"],
            ],
        ]);

        dd($result->choices[0]);
    }

    /*
        * This function is inted to be used for testing and development for new features
    */
/*     public function index()  {

        $result = OpenAI::chat()->create([
            'model' => $this->chatModel,
            'messages' => [
                $this->basePromptChat,
                ['role' => 'user', 'content' => "PostTitle: [Craving for some delicious meat?]"],
                ['role' => 'user', 'content' => "PostDescription: [Indulge in the best Wagyu beef from Japan at our food court sale! Get a mouthwatering 50% off on all meat items for a limited time only. Hurry, your taste buds will thank you!]"],
                ['role' => 'user', 'content' => "Create Tags for post base on the inforation"],
            ],
        ]);

        dd($result->choices[0]);
    } */


    public function image(Request $request)  {
        $iamgeData = $request->input('imageData');
        if (!$iamgeData) { return response()->json(['error' => 'Image Data is required']);}

        $response = OpenAI::images()->create([
            'model' => 'dall-e-2',
            'n' => 1,
            'prompt' => $iamgeData,
            'response_format' => 'b64_json',
        ]);

        return response()->json($response->data);
    }
}
