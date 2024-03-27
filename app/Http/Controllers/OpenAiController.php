<?php

namespace App\Http\Controllers;

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
    public function createPostDescription(Request $request)
    {
        $postTitle = $request->input('postTitle');

        if (!$postTitle) {
            return response()->json(['error' => 'Post Title is required']);
        }

        $result = OpenAI::chat()->create([
            'model' => $this->chatModel,
            'messages' => [
                $this->basePromptChat,
                ['role' => 'user', 'content' => "PostTitle: [" . $postTitle . "]"],
                ['role' => 'system', 'content' => 'Write a catchy caption / decriptions for the post. No tags.'],
            ],
        ]);

        return response()->json($result->choices[0]->message->content);
    }
    /*
        * This function create a post for a campain based on the information provided
    */
    public function createPostFromCampain()
    {
        $result = OpenAI::chat()->create([
            'model' => $this->chatModel,
            'messages' => [
                $this->basePromptChat,
                ['role' => 'user', 'content' => "CampainTitle: [Food Court Sale Camapin]"],
                ['role' => 'user', 'content' => "CampainDescription: [Get 50% off on all food items at the food court. Offer valid for a limited time only. Hurry!]"],
                ['role' => 'user', 'content' => "CampainNiche: [Food Sale Meat"],
                ['role' => 'user', 'content' => "CampainProductFeatures: [Meat soo good you will never want to leave the food court.]"],
                ['role' => 'user', 'content' => "CampainProductDescription: [red Wague meat form Japan, and the best beef in the world.]"],
                ['role' => 'system', 'content' => 'Genretea a post for the campain. in this fromat [PostTitle: [REponce GEnerated] PostDescription: [REponce GEnerated]']
            ],
        ]);

        dd($result->choices[0]);
    }
    /*
        * This function create tags for a post based on the information provided
    */
    public function createPostTags()
    {
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
    public function index() // 
    {
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
}
