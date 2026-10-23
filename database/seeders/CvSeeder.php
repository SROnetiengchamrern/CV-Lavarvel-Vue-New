<?php

namespace Database\Seeders;

use App\Models\AwsCourse;
use App\Models\CvReference;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Interest;
use App\Models\Language;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\Training;
use Illuminate\Database\Seeder;

class CvSeeder extends Seeder
{
    public function run(): void
    {
        Profile::query()->delete();
        Skill::query()->delete();
        SkillCategory::query()->delete();
        Language::query()->delete();
        Education::query()->delete();
        Experience::query()->delete();
        Training::query()->delete();
        AwsCourse::query()->delete();
        Interest::query()->delete();
        CvReference::query()->delete();

        Profile::create([
            'full_name' => 'Tieng Chamrern',
            'full_name_km' => 'ទៀង​ ចំរើន',
            'title' => 'Full Stack Developer',
            'title_km' => 'Full Stack Developer',
            'photo' => 'images/profile.jpg',
            'email' => 'tiengchamrern2@gmail.com',
            'phone_primary' => '096 779 7762',
            'phone_secondary' => '081 6666 819',
            'telegram' => 'https://t.me/TienG_ChamrerN_BTC',
            'facebook' => 'https://www.facebook.com/tieng.chamrern.2025/',
            'address' => 'Phum Sepese, Sangkat Teuk Thla, Khan Sansokh, Phnom Penh, Cambodia',
            'address_km' => 'ភូមិសេប៉េសេ សង្កាត់ទឹកថ្លា ខណ្ឌសែនសុខ រាជធានីភ្នំពេញ កម្ពុជា',
            'gender' => 'Male',
            'gender_km' => 'ប្រុស',
            'date_of_birth' => '10-November-2003',
            'marital_status' => 'Single',
            'marital_status_km' => 'នៅលីវ',
            'nationality' => 'Khmer',
            'nationality_km' => 'ខ្មែរ',
            'place_of_birth' => 'Taing Srey Village, Mepring Commune, Batheay District, Kompong Cham Province.',
            'place_of_birth_km' => 'ភូមិតាំងស្រី ឃុំមេព្រីង ស្រុកបាធាយ ខេត្តកំពង់ចាម',
            'layout' => 'classic',
            'cover_letter_enabled' => true,
            'cover_letter_salutation' => 'Dear Sir / Madam,',
            'cover_letter_salutation_km' => 'សូមគោរព ឯកឧត្តម / លោក / លោកស្រី,',
            'cover_letter_body' => "I am writing to express my strong interest in the Web Developer position. I hold a Bachelor's Degree in Management Information Systems and have more than three years of practical experience building web applications.\n\nAt Khmer Gaming Software Solution Co., Ltd., I have worked on front-end and back-end development using HTML, CSS, JavaScript, PHP, Node.js, React.js, Laravel, and Vue.js, including UI/UX design and platform integration.\n\nI also have experience with technical troubleshooting, hardware and software repair for laptops and desktops, smartphones, and basic office network setup.",
            'cover_letter_body_km' => "ខ្ញុំសូមសរសេរមកដើម្បីបង្ហាញពីចំណាប់អារម្មណ៍ខ្លាំងរបស់ខ្ញុំចំពោះតួនាទីអ្នកអភិវឌ្ឍន៍គេហទំព័រ។ ខ្ញុំមានសញ្ញាបត្របរិញ្ញាបត្រផ្នែកប្រព័ន្ធព័ត៌មានគ្រប់គ្រង (MIS) និងមានបទពិសោធន៍ជាង ៣ ឆ្នាំក្នុងការបង្កើតកម្មវិធីគេហទំព័រ។\n\nនៅក្រុមហ៊ុន Khmer Gaming Software Solution Co., Ltd. ខ្ញុំបានធ្វើការអភិវឌ្ឍន៍ front-end និង back-end ដោយប្រើ HTML, CSS, JavaScript, PHP, Node.js, React.js, Laravel និង Vue.js រួមទាំងការរចនា UI/UX និងការភ្ជាប់ប្រព័ន្ធ។\n\nខ្ញុំក៏មានបទពិសោធន៍ក្នុងការដោះស្រាយបញ្ហាបច្ចេកទេស ការជួសជុលហាត់វែរ និងសូហ្វវែរសម្រាប់កុំព្យូទ័រ ស្មាតហ្វូន និងការដំឡើងបណ្តាញការិយាល័យមូលដ្ឋាន។",
            'cover_letter_closing' => "I would welcome the opportunity to discuss how I can contribute to your team. Please feel free to contact me by phone or email.\n\nThank you for your time and consideration.",
            'cover_letter_closing_km' => "ខ្ញុំសូមស្វាគមន៍ឱកាសពិភាក្សាអំពីរបៀបដែលខ្ញុំអាចចូលរួមចំណែកក្នុងក្រុមរបស់លោក/លោកស្រី។ សូមទំនាក់ទំនងមកខ្ញុំតាមទូរស័ព្ទ ឬអ៊ីមែល។\n\nសូមអរគុណចំពោះពេលវេលា និងការពិចារណារបស់លោក/លោកស្រី។",
            'cover_letter_signature' => 'Tieng Chamrern',
            'cover_letter_signature_km' => 'ទៀង ចំរើន',
        ]);

        $categories = [
            ['Personal Skills', 'ជំនាញផ្ទាល់ខ្លួន', 'personal', 'Skills', 'ជំនាញ', true, false, 0],
            ['SETEC Institute', 'វិទ្យាស្ថាន SETEC', 'setec', 'Skills', 'ជំនាញ', false, false, 1],
            ['Technical Skills', 'ជំនាញបច្ចេកទេស', 'technical', 'Skills', 'ជំនាញ', false, false, 2],
            ['Master IT School', 'សាលា Master IT', 'master_it', 'Skills', 'ជំនាញ', false, true, 3],
        ];

        foreach ($categories as [$name, $nameKm, $slug, $section, $sectionKm, $showBars, $accent, $sort]) {
            SkillCategory::create([
                'name' => $name,
                'name_km' => $nameKm,
                'slug' => $slug,
                'section' => $section,
                'section_km' => $sectionKm,
                'show_bars' => $showBars,
                'accent' => $accent,
                'sort_order' => $sort,
            ]);
        }

        $personalSkills = [
            ['CSS', 90],
            ['HTML', 92],
            ['PHP', 88],
            ['Laravel', 90],
            ['Database', 85],
            ['Javascript', 88],
            ['WordPress', 80],
            ['Joomla', 75],
            ['Bootstrap', 90],
            ['Vue JS', 88],
            ['React JS', 82],
            ['Jquery', 85],
        ];

        foreach ($personalSkills as $i => [$name, $level]) {
            Skill::create([
                'name' => $name,
                'level' => $level,
                'category' => 'personal',
                'show_bar' => true,
                'sort_order' => $i,
            ]);
        }

        foreach (['HTML', 'CSS', 'PHP', 'JavaScript', 'WordPress'] as $i => $name) {
            Skill::create([
                'name' => $name,
                'level' => 85,
                'category' => 'setec',
                'show_bar' => false,
                'sort_order' => $i,
            ]);
        }

        $techSkills = [
            'Joomla', 'Laravel', 'Database', 'Flutter', 'ASP.NET', 'Django',
            'Spring Tool', 'Java', 'C#', 'Linux', 'C++', 'MYSQL',
            'SQL Server', 'Navicat', 'GitHub', 'GitLab',
        ];

        foreach ($techSkills as $i => $name) {
            Skill::create([
                'name' => $name,
                'level' => 80,
                'category' => 'technical',
                'show_bar' => false,
                'sort_order' => $i,
            ]);
        }

        foreach (['Vue JS', 'Quasar', 'JavaScript', 'BootStrap', 'Dynamic Website'] as $i => $name) {
            Skill::create([
                'name' => $name,
                'level' => 85,
                'category' => 'master_it',
                'show_bar' => false,
                'sort_order' => $i,
            ]);
        }

        Language::create(['name' => 'Khmer', 'name_km' => 'ខ្មែរ', 'level' => 10, 'sort_order' => 0]);
        Language::create(['name' => 'English', 'name_km' => 'អង់គ្លេស', 'level' => 4, 'sort_order' => 1]);

        $education = [
            ['2023 - Present', 'SETEC INSTITUTE', 'វិទ្យាស្ថាន SETEC', 'Master\'s Degree of Management Information System (MIS)', 'បរិញ្ញាបត្រជាន់ខ្ពស់ផ្នែកប្រព័ន្ធព័ត៌មានគ្រប់គ្រង (MIS)'],
            ['2019 - 2023', 'SETEC INSTITUTE', 'វិទ្យាស្ថាន SETEC', 'Bachelor\'s Degree of Management Information System (MIS)', 'បរិញ្ញាបត្រផ្នែកប្រព័ន្ធព័ត៌មានគ្រប់គ្រង (MIS)'],
            ['2016 - 2019', 'Hun Sen Ang Snoul High School', 'វិទ្យាល័យ ហ៊ុន សែន អង្គស្នួល', 'High School', 'មធ្យមសិក្សាទុតិយភូមិ'],
            ['2010 - 2016', 'Ang Snoul Secondary School', 'អនុវិទ្យាល័យ អង្គស្នួល', 'Secondary School', 'មធ្យមសិក្សាបឋមភូមិ'],
            ['2006 - 2010', 'Ang Snoul Primary School', 'សាលាបឋមសិក្សា អង្គស្នួល', 'Primary School', 'បឋមសិក្សា'],
        ];

        foreach ($education as $i => [$years, $institution, $institutionKm, $description, $descriptionKm]) {
            Education::create([
                'years' => $years,
                'institution' => $institution,
                'institution_km' => $institutionKm,
                'description' => $description,
                'description_km' => $descriptionKm,
                'sort_order' => $i,
            ]);
        }

        $experiences = [
            [
                '2023 - Present',
                'Khmer Gaming Software Solution Co., Ltd.',
                'ក្រុមហ៊ុន Khmer Gaming Software Solution',
                'Software Developer',
                'អ្នកអភិវឌ្ឍន៍សូហ្វវែរ',
                [
                    'Game Development (Mobile, Web, Desktop)',
                    'Platform Integration (API / Third-party)',
                    'UI/UX Design',
                ],
                [
                    'ការអភិវឌ្ឍន៍ហ្គេម (Mobile, Web, Desktop)',
                    'ការភ្ជាប់ប្រព័ន្ធ (API / Third-party)',
                    'ការរចនា UI/UX',
                ],
            ],
            [
                '2019 - 2023',
                'SETEC INSTITUTE',
                'វិទ្យាស្ថាន SETEC',
                'Web Developer',
                'អ្នកអភិវឌ្ឍន៍គេហទំព័រ',
                ['Build System and Website'],
                ['បង្កើតប្រព័ន្ធ និងគេហទំព័រ'],
            ],
            [
                '2022 - 2023',
                'Katappraisal CO., LTD.',
                'ក្រុមហ៊ុន Katappraisal',
                'Manager',
                'អ្នកគ្រប់គ្រង',
                ['Real Estate Management System'],
                ['ប្រព័ន្ធគ្រប់គ្រងអចលនទ្រព្យ'],
            ],
            [
                '2021 - 2022',
                'Anakut Digital',
                'អនាគត ឌីជីថល',
                'Internship',
                'សិក្សាការងារ',
                ['POS, Accounting, HR, School, Money Exchange systems'],
                ['ប្រព័ន្ធ POS គណនេយ្យ HR សាលា និងប្តូរប្រាក់'],
            ],
            [
                '2020 - 2021',
                'CAD-CAM LABORATORY',
                'មន្ទីរពិសោធន៍ CAD-CAM',
                'Dental Design',
                'ការរចនាធ្មេញ',
                ['Dental Design'],
                ['ការរចនាធ្មេញ'],
            ],
        ];

        foreach ($experiences as $i => [$years, $company, $companyKm, $role, $roleKm, $highlights, $highlightsKm]) {
            Experience::create([
                'years' => $years,
                'company' => $company,
                'company_km' => $companyKm,
                'role' => $role,
                'role_km' => $roleKm,
                'highlights' => $highlights,
                'highlights_km' => $highlightsKm,
                'sort_order' => $i,
            ]);
        }

        $trainings = [
            ['Completed English Course at SETEC Institute', 'បានបញ្ចប់វគ្គភាសាអង់គ្លេសនៅវិទ្យាស្ថាន SETEC'],
            ['Completed Microsoft Office Training at Appbook Computer Center', 'បានបញ្ចប់ការបណ្តុះបណ្តាល Microsoft Office នៅ Appbook Computer Center'],
            ['Passed Bacc II Exam && Deplume', 'បានជាប់ប្រឡងមធ្យមសិក្សាទុតិយភូមិ នឹង មធ្យមសិក្សាបឋមភូមិ'],
            ['Completed English Course New Headway (Elementary–Intermediate) Level 1–5', 'បានបញ្ចប់វគ្គភាសាអង់គ្លេស New Headway (Elementary–Intermediate) កម្រិត ១–៥'],
        ];

        foreach ($trainings as $i => [$description, $descriptionKm]) {
            Training::create([
                'description' => $description,
                'description_km' => $descriptionKm,
                'sort_order' => $i,
            ]);
        }

        $awsCourses = [
            ['AWS Academy Cloud Architecting', 'វគ្គ AWS Academy Cloud Architecting', '109663', '#ec4899'],
            ['AWS Academy Cloud Architecting', 'វគ្គ AWS Academy Cloud Architecting', '120207', '#92400e'],
            ['AWS Academy Cloud Foundations', 'វគ្គ AWS Academy Cloud Foundations', '106834', '#0d9488'],
            ['AWS Academy Cloud Operations', 'វគ្គ AWS Academy Cloud Operations', '122639', '#166534'],
            ['AWS Academy Cloud Security Foundations', 'វគ្គ AWS Academy Cloud Security Foundations', '122638', '#15803d'],
            ['AWS Academy Data Engineering', 'វគ្គ AWS Academy Data Engineering', '108729', '#db2777'],
            ['AWS Academy Machine Learning Foundations', 'វគ្គ AWS Academy Machine Learning Foundations', '106835', '#2563eb'],
        ];

        foreach ($awsCourses as $i => [$title, $titleKm, $code, $color]) {
            AwsCourse::create([
                'title' => $title,
                'title_km' => $titleKm,
                'course_code' => $code,
                'role' => 'Student',
                'role_km' => 'សិស្ស',
                'is_completed' => true,
                'badge_color' => $color,
                'sort_order' => $i,
            ]);
        }

        $interests = [
            ['Playing football, boxing, and volleyball', 'លេងបាល់ទាត់ ប្រដាល់ និងបាល់ទះ'],
            ['Reading books and listening to music', 'អានសៀវភៅ និងស្តាប់តន្ត្រី'],
            ['Sharing knowledge with others', 'ចែករំលែកចំណេះដឹងជាមួយអ្នកដទៃ'],
        ];

        foreach ($interests as $i => [$description, $descriptionKm]) {
            Interest::create([
                'description' => $description,
                'description_km' => $descriptionKm,
                'sort_order' => $i,
            ]);
        }

        CvReference::create([
            'name' => 'Mr. Hor Sothy',
            'name_km' => 'លោក ហោ សុធី',
            'title' => 'Engineering',
            'title_km' => 'វិស្វកម្ម',
            'organization' => 'National Technical Training Institute (NTTI)',
            'organization_km' => 'វិទ្យាស្ថានបណ្តុះបណ្តាលបច្ចេកទេសជាតិ (NTTI)',
            'phone' => '093 947 311',
            'sort_order' => 0,
        ]);

        CvReference::create([
            'name' => 'Mr. Kim Vanna',
            'name_km' => 'លោក គឹម វណ្ណា',
            'title' => 'Management Information System',
            'title_km' => 'ប្រព័ន្ធព័ត៌មានគ្រប់គ្រង',
            'organization' => 'SETEC INSTITUTE',
            'organization_km' => 'វិទ្យាស្ថាន SETEC',
            'phone' => '010 591 330',
            'sort_order' => 1,
        ]);
    }
}
