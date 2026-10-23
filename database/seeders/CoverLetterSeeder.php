<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class CoverLetterSeeder extends Seeder
{
    public function run(): void
    {
        $profile = Profile::query()->first();

        if (! $profile) {
            return;
        }

        $profile->update([
            'cover_letter_enabled' => true,
            'cover_letter_salutation' => 'Dear Sir / Madam,',
            'cover_letter_salutation_km' => 'សូមគោរព ឯកឧត្តម / លោក / លោកស្រី,',
            'cover_letter_body' => "I am writing to express my strong interest in the Web Developer position. I hold a Bachelor's Degree in Management Information Systems and have more than three years of practical experience building web applications.\n\nAt Khmer Gaming Software Solution Co., Ltd., I have worked on front-end and back-end development using HTML, CSS, JavaScript, PHP, Node.js, React.js, Laravel, and Vue.js, including UI/UX design and platform integration.\n\nI also have experience with technical troubleshooting, hardware and software repair for laptops and desktops, smartphones, and basic office network setup.",
            'cover_letter_body_km' => "ខ្ញុំសូមសរសេរមកដើម្បីបង្ហាញពីចំណាប់អារម្មណ៍ខ្លាំងរបស់ខ្ញុំចំពោះតួនាទីអ្នកអភិវឌ្ឍន៍គេហទំព័រ។ ខ្ញុំមានសញ្ញាបត្របរិញ្ញាបត្រផ្នែកប្រព័ន្ធព័ត៌មានគ្រប់គ្រង (MIS) និងមានបទពិសោធន៍ជាង ៣ ឆ្នាំក្នុងការបង្កើតកម្មវិធីគេហទំព័រ។\n\nនៅក្រុមហ៊ុន Khmer Gaming Software Solution Co., Ltd. ខ្ញុំបានធ្វើការអភិវឌ្ឍន៍ front-end និង back-end ដោយប្រើ HTML, CSS, JavaScript, PHP, Node.js, React.js, Laravel និង Vue.js រួមទាំងការរចនា UI/UX និងការភ្ជាប់ប្រព័ន្ធ។\n\nខ្ញុំក៏មានបទពិសោធន៍ក្នុងការដោះស្រាយបញ្ហាបច្ចេកទេស ការជួសជុលហាត់វែរ និងសូហ្វវែរសម្រាប់កុំព្យូទ័រ ស្មាតហ្វូន និងការដំឡើងបណ្តាញការិយាល័យមូលដ្ឋាន។",
            'cover_letter_closing' => "I would welcome the opportunity to discuss how I can contribute to your team. Please feel free to contact me by phone or email.\n\nThank you for your time and consideration.",
            'cover_letter_closing_km' => "ខ្ញុំសូមស្វាគមន៍ឱកាសពិភាក្សាអំពីរបៀបដែលខ្ញុំអាចចូលរួមចំណែកក្នុងក្រុមរបស់លោក/លោកស្រី។ សូមទំនាក់ទំនងមកខ្ញុំតាមទូរស័ព្ទ ឬអ៊ីមែល។\n\nសូមអរគុណចំពោះពេលវេលា និងការពិចារណារបស់លោក/លោកស្រី។",
            'cover_letter_signature' => 'Tieng Chamrern',
            'cover_letter_signature_km' => 'ធីង ចាំរឿន',
        ]);
    }
}
