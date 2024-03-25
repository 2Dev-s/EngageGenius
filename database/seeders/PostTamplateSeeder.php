<?php

namespace Database\Seeders;

use App\Models\PromptTamplate;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostTamplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $propmtTamplates = [
            [
                'name' => 'Promoting a New Product Launch',
                'prompt' => "Generate [NUMBER] day(s) engaging social media post announcing the launch of our latest [NICHE], the [PRODUCT. Highlights its [FEATURE]. Include a call-to-action [CTA].",
                'image_prompt' => "Create an image showcasing a [FEATURE] [PRODUCT]. The background should be minimalist and modern, emphasizing the [FEATURE]. Include a subtle, digital texture to convey its cutting-edge [NICHE].",
            ],
            [
                'name' => 'Announcing a Seasonal Sale',
                'prompt' => "Craft [NUMBER] day(s) captivating social media post for our [NICHE] announcing our upcoming [PROMOTE]. Emphasize the [FEATURE]. Encourage followers to [CTA] and mention the sale date [DATE].",
                'image_prompt' => "Design an image that [FEATURE_IMAGE]. Overlay text announcing the 'Summer Sale' with dates [DATE] and discounts visible [DISCOUNT], styled in a way that complements the [FEATURE] theme.",
            ],
            [
                'name' => 'Sharing a Customer Testimonial',
                'prompt' => "Write [NUMBER] day(s) social media post for our [PRODUCT], incorporating a recent customer testimonial about their [FEATURE]. Highlight our commitment to quality and personalized service. End with an invitation for followers to contact us for a free consultation.",
                'image_prompt' => "Generate an image depicting a [FEATURE_IMAGE]. The image should evoke a sense of tranquility and attention to detail, representing our service quality.",
            ],
            [
                'name' => 'Promoting an Educational Event/Webinar',
                'prompt' => "Create [NUMBER] day(s) engaging post for our business, promoting an upcoming [PRODUCT]. Detail the key topics, including [FEATURE]. Include the webinar date [DATE], and a link to register [LINK].",
                'image_prompt' => "Produce an image that conveys a professional and educational tone, featuring abstract representations of data analytics, such as graphs and digital interfaces. Integrate the event details into the design in a clear, visually appealing manner.",
            ],
            [
                'name' => 'Sustainability Initiative (Eco-Friendly Products)',
                'prompt' => "Draft [NUMBER] day(s) post for our eco-friendly product line [PRODUCT], spotlighting our recent sustainability initiative to reduce greenhouse effect. Share insights into the initiative's impact and our commitment to a greener planet. Encourage followers to support by choosing eco-friendly options.",
                'image_prompt' => "Create an image that visually represents sustainability, featuring our eco-friendly products, and elements of nature like leaves or recycled materials. The overall theme should inspire action towards environmental conservation, with a positive, hopeful tone.",
            ],
            [
                'name' => 'Community Event (Local Business)',
                'prompt' => "Compose [NUMBER] day(s) lively social media post for our [PRODUCT] announcing a community gathering event featuring [FEATURE]. Highlight the event date [DATE], the special guests, and our mission to foster community connections. Encourage followers to RSVP and bring friends.",
                'image_prompt' => "Generate an image that captures the essence of a cozy, vibrant community event at [PRODUCT], with visual elements like [FEATURE_IMAGE]. The atmosphere should be warm and inviting, with a clear indication of the event details.",
            ],
            [
                'name' => 'Introducing a Loyalty Program',
                'prompt' => "Craft an enticing social media post for our [PRODUCT], introducing loyalty program. Detail the benefits, such as [FEATURE]. Motivate followers to sign up by highlighting the value and simplicity of joining.",
                'image_prompt' => "Design an image that visually represents a loyalty card adorned with [FEATURE_IMAGE]. The theme should convey exclusivity and the joy of being a valued member.",
            ],
            [
                'name' => 'Celebrating a Company Milestone',
                'prompt' => "Develop an enthusiastic social media post for our business, celebrating our [PRODUCT] and reflecting on [FEATURE]. Express gratitude towards our customers and team, and tease upcoming innovations.",
                'image_prompt' => "Generate an image that captures the spirit of innovation and community, possibly incorporating visual elements like a timeline, highlights of products, and diverse team members. The design should convey a sense of accomplishment and forward-looking optimism.",
            ],
            [
                'name' => 'Viral Engagement Challenge (Teachers & Trainers)',
                'prompt' => "Compose [NUMBER] day(s) inspiring social media post for our brand, launching a [PRODUCT]. Outline the daily actions participants can take to [FEATURE]. Highlight the collective impact of individual actions.",
                'image_prompt' => "Design an image that visually represents the concept of a 'result-driven challenge,' with elements like [FEATURE_IMAGE], and a vibrant, positive color scheme. The imagery should motivate participation and emphasize the community aspect of the challenge.",
            ],
            [
                'name' => 'Showcasing a Product How-To',
                'prompt' => "Write [NUMBER] days concise, informative social media post for our [NICHE], showcasing a quick tutorial on using our [PRODUCT]. Focus on the benefits [FEATURE] and demonstrate a simple daily routine. Include a call-to-action directing followers to our website for more tips.",
                'image_prompt' => "Create an image sequence or a composite that visually guides through the steps of applying our [NICHE] products, from [FEATURE_IMAGE]. The imagery should emphasize [FEATURE].",
            ],
            [
                'name' => 'Professional Development Training Program',
                'prompt' => "Compose [NUMBER] days inspiring social media post for our [PRODUCT]. Highlight the program's [FEATURE]. Mention the [CTA].",
                'image_prompt' => "Create an image that symbolizes [FEATURE_IMAGE]. Ensure the design communicates progression, ambition, and the transformative journey of the training program.",
            ],
            [
                'name' => 'Announcing a New Book Launch',
                'prompt' => "Generate [NUMBER] day(s) engaging post announcing the launch of our latest [NICHE] book, '[PRODUCT]' Emphasize how the book offers [FEATURE]. Include [CTA]",
                'image_prompt' => "Design an image featuring the book cover prominently in an inviting, warm setting, possibly with a cozy reading nook in the background. Add visual elements that suggest [FEATURE_IMAGE].",
            ],
            [
                'name' => 'Online Course Offering',
                'prompt' => "Write [NUMBER] days compelling social media post for our new online course, '[PRODUCT]' Focus on how the course covers [FEATURE]. Highlight the flexibility of the learning platform and the practical skills participants will gain.",
                'image_prompt' => "Generate an image that visualizes the dynamic world of [FEATURE_IMAGE]. The design should suggest a pathway through the landscape, leading towards mastery and success.",
            ],
            [
                'name' => 'Promoting Expert Services',
                'prompt' => "Craft [NUMBER] days sensitive yet informative post for our [NICHE], emphasizing our expertise in handling [FEATURE]. Share a brief success story or testimonial that illustrates our commitment to our clients' best interests.",
                'image_prompt' => "Create a visual that conveys trust, support, and confidentiality, using imagery like a handshake, a protective umbrella, or a calm, serene office environment. The image should communicate the peace of mind that comes from having [NICHE] representation.",
            ],
            [
                'name' => 'Chiropractic Wellness Package',
                'prompt' => "Develop [NUMBER] days health-focused social media post for our chiropractic clinic, promoting our new [PRODUCT]. Detail the benefits of chiropractic care for overall health, including [FEATURE]. Mention [CTA].",
                'image_prompt' => "Produce an image that embodies wellness and balance, featuring a human figure in a posture of relief or alignment, possibly with a backdrop of serene nature or a calm, healing environment. Incorporate symbols of health like a spine or a leaf to underscore the chiropractic focus.",
            ]

        ];
        foreach ($propmtTamplates as $propmtTamplate) { PromptTamplate::create($propmtTamplate); }
        
    }
}
