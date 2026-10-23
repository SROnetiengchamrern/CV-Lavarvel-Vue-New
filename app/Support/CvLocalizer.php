<?php

namespace App\Support;

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
use Illuminate\Support\Collection;

class CvLocalizer
{
    public static function ui(): array
    {
        return trans('cv');
    }

    public static function profile(?Profile $profile): ?array
    {
        if (! $profile) {
            return null;
        }

        return [
            'id' => $profile->id,
            'full_name' => Locale::pick($profile->full_name, $profile->full_name_km),
            'title' => Locale::pick($profile->title, $profile->title_km),
            'photo' => $profile->photo,
            'email' => $profile->email,
            'phone_primary' => $profile->phone_primary,
            'phone_secondary' => $profile->phone_secondary,
            'telegram' => $profile->telegram,
            'telegram_url' => self::telegramUrl($profile->telegram),
            'facebook' => $profile->facebook,
            'facebook_url' => self::facebookUrl($profile->facebook),
            'address' => Locale::pick($profile->address, $profile->address_km),
            'gender' => Locale::pick($profile->gender, $profile->gender_km),
            'date_of_birth' => $profile->date_of_birth,
            'marital_status' => Locale::pick($profile->marital_status, $profile->marital_status_km),
            'nationality' => Locale::pick($profile->nationality, $profile->nationality_km),
            'place_of_birth' => Locale::pick($profile->place_of_birth, $profile->place_of_birth_km),
            'layout' => $profile->layout,
            'cover_letter_enabled' => $profile->cover_letter_enabled,
        ];
    }

    public static function coverLetter(?Profile $profile): ?array
    {
        if (! $profile) {
            return null;
        }

        $body = Locale::pick($profile->cover_letter_body, $profile->cover_letter_body_km);
        if (! $profile->cover_letter_enabled || blank($body)) {
            return null;
        }

        return [
            'profile' => self::profile($profile),
            'photo_url' => $profile->photo_url,
            'salutation' => Locale::pick(
                $profile->cover_letter_salutation ?: 'Dear Sir / Madam,',
                $profile->cover_letter_salutation_km
            ),
            'body' => $body,
            'closing' => Locale::pick($profile->cover_letter_closing, $profile->cover_letter_closing_km),
            'signature' => Locale::pick(
                $profile->cover_letter_signature ?: $profile->full_name,
                $profile->cover_letter_signature_km
            ),
        ];
    }

    public static function skillGroups(Collection $categories): Collection
    {
        return $categories
            ->groupBy(fn (SkillCategory $cat) => Locale::pick($cat->section, $cat->section_km) ?: $cat->section)
            ->map(function (Collection $items, string $section) {
                return [
                    'section' => $section,
                    'categories' => $items->map(function (SkillCategory $category) {
                        return [
                            'id' => $category->id,
                            'name' => Locale::pick($category->name, $category->name_km),
                            'show_bars' => $category->show_bars,
                            'accent' => $category->accent,
                            'skills' => $category->skills->map(fn (Skill $skill) => [
                                'id' => $skill->id,
                                'name' => Locale::pick($skill->name, $skill->name_km),
                                'level' => $skill->level,
                            ])->values(),
                        ];
                    })->values(),
                ];
            })
            ->values();
    }

    public static function languages(Collection $items): Collection
    {
        return $items->map(fn (Language $item) => [
            'id' => $item->id,
            'name' => Locale::pick($item->name, $item->name_km),
            'level' => $item->level,
        ])->values();
    }

    public static function education(Collection $items): Collection
    {
        return $items->map(fn (Education $item) => [
            'id' => $item->id,
            'years' => $item->years,
            'institution' => Locale::pick($item->institution, $item->institution_km),
            'description' => Locale::pick($item->description, $item->description_km),
            'documents' => $item->documents,
        ])->values();
    }

    public static function experiences(Collection $items): Collection
    {
        return $items->map(fn (Experience $item) => [
            'id' => $item->id,
            'years' => $item->years,
            'company' => Locale::pick($item->company, $item->company_km),
            'role' => Locale::pick($item->role, $item->role_km),
            'highlights' => Locale::pickArray($item->highlights, $item->highlights_km),
        ])->values();
    }

    public static function trainings(Collection $items): Collection
    {
        return $items->map(fn (Training $item) => [
            'id' => $item->id,
            'description' => Locale::pick($item->description, $item->description_km),
        ])->values();
    }

    public static function interests(Collection $items): Collection
    {
        return $items->map(fn (Interest $item) => [
            'id' => $item->id,
            'description' => Locale::pick($item->description, $item->description_km),
        ])->values();
    }

    public static function references(Collection $items): Collection
    {
        return $items->map(fn (CvReference $item) => [
            'id' => $item->id,
            'name' => Locale::pick($item->name, $item->name_km),
            'title' => Locale::pick($item->title, $item->title_km),
            'organization' => Locale::pick($item->organization, $item->organization_km),
            'phone' => $item->phone,
        ])->values();
    }

    public static function awsCourses(Collection $items): Collection
    {
        return $items->map(fn (AwsCourse $item) => [
            'id' => $item->id,
            'title' => Locale::pick($item->title, $item->title_km),
            'display_title' => Locale::pick($item->title, $item->title_km)
                .($item->course_code ? ' ['.$item->course_code.']' : ''),
            'course_code' => $item->course_code,
            'role' => Locale::pick($item->role, $item->role_km),
            'is_completed' => $item->is_completed,
            'badge_color' => $item->badge_color,
            'certificates' => $item->certificates,
        ])->values();
    }

    public static function telegramUrl(?string $value): ?string
    {
        if (blank($value)) {
            return null;
        }

        $value = trim($value);
        if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://')) {
            return $value;
        }

        return 'https://t.me/'.ltrim($value, '@');
    }

    public static function facebookUrl(?string $value): ?string
    {
        if (blank($value)) {
            return null;
        }

        $value = trim($value);
        if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://')) {
            return $value;
        }

        return 'https://facebook.com/'.ltrim($value, '@/');
    }

    /**
     * All uploaded certificate images/PDFs (AWS courses + degree documents).
     */
    public static function certificateGallery(): array
    {
        $items = [];

        $courses = AwsCourse::with('certificates')->orderBy('sort_order')->orderBy('title')->get();
        foreach ($courses as $course) {
            $courseTitle = Locale::pick($course->title, $course->title_km) ?: $course->title;
            foreach ($course->certificates as $cert) {
                $items[] = [
                    'id' => 'aws-'.$cert->id,
                    'title' => $cert->title ?: $courseTitle,
                    'subtitle' => $courseTitle,
                    'group' => 'aws',
                    'url' => $cert->url,
                    'is_image' => $cert->is_image,
                    'is_pdf' => $cert->is_pdf,
                    'original_name' => $cert->original_name,
                ];
            }
        }

        $education = Education::with('documents')->orderBy('sort_order')->get();
        foreach ($education as $edu) {
            $institution = Locale::pick($edu->institution, $edu->institution_km) ?: $edu->institution;
            foreach ($edu->documents as $doc) {
                $items[] = [
                    'id' => 'edu-'.$doc->id,
                    'title' => $doc->title ?: $institution,
                    'subtitle' => $institution,
                    'group' => 'education',
                    'url' => $doc->url,
                    'is_image' => $doc->is_image,
                    'is_pdf' => $doc->is_pdf,
                    'original_name' => $doc->original_name,
                ];
            }
        }

        return $items;
    }
}
