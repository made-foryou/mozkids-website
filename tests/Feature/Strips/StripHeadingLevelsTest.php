<?php

declare(strict_types=1);

namespace Tests\Feature\Strips;

use App\Strips\AgendaStrip;
use App\Strips\BlocksContentStrip;
use App\Strips\BoardMembersStrip;
use App\Strips\CookieDeclarationStrip;
use App\Strips\CoreValuesStrip;
use App\Strips\FaqStrip;
use App\Strips\HeroStrip;
use App\Strips\PageFillableContentStrip;
use App\Strips\TextStrip;
use App\Strips\ThreeColumnStrip;
use App\Strips\TimelineStrip;
use App\Strips\TwoColumnsStrip;
use App\Strips\YearReportsStrip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class StripHeadingLevelsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Per strip: de class, minimale data, de CSS-class van de titel en de tag
     * die bestaande content (zonder opgeslagen niveau) moet blijven krijgen.
     *
     * @return array<string, array{class-string, array<string, mixed>, string, string, string}>
     */
    public static function strips(): array
    {
        return [
            'tekst' => [TextStrip::class, ['title' => 'Titel', 'content' => '<p>Tekst</p>'], 'title_level', 'text-strip__title', 'h1'],
            'cookieverklaring' => [CookieDeclarationStrip::class, ['subtitle' => null, 'title' => 'Titel', 'url' => 'https://consent.cookiebot.com/x/cd.js'], 'title_level', 'text-strip__title', 'h1'],
            'agenda' => [AgendaStrip::class, ['title' => 'Agenda'], 'title_level', 'agenda-strip__title', 'h1'],
            'faq' => [FaqStrip::class, self::faq(), 'title_level', 'faq-strip__title', 'h2'],
            'tijdlijn' => [TimelineStrip::class, self::timeline(), 'title_level', 'timeline-strip__title', 'h2'],
            'bestuur' => [BoardMembersStrip::class, self::boardMembers(), 'title_level', 'board-members-strip__title', 'h2'],
            'jaarverslagen' => [YearReportsStrip::class, ['subtitle' => null, 'title' => 'Jaarverslagen'], 'title_level', 'year-reports-strip__title', 'h2'],
            // De items delen de class van de titel; zet ze op "geen kop" zodat alleen de titel telt.
            'kernwaarden' => [CoreValuesStrip::class, [...self::coreValues(), 'values' => [['icon' => 'rocket', 'title' => 'Waarde', 'content' => null, 'title_level' => 'none']]], 'title_level', 'core-card__title', 'div'],
            'pagina vullend' => [PageFillableContentStrip::class, ['title' => '404', 'content' => 'Niet gevonden', 'label' => null, 'link' => null], 'title_level', 'block mb-10', 'span'],
            'hero' => [HeroStrip::class, ['content' => 'Welkom', 'buttons' => []], 'heading_level', 'hero-heading', 'span'],
        ];
    }

    #[Test]
    #[DataProvider('strips')]
    public function it_keeps_the_original_tag_for_existing_content(string $strip, array $data, string $key, string $class, string $tag): void
    {
        $this->assertTag($tag, $class, $strip::render($data)->render());
    }

    #[Test]
    #[DataProvider('strips')]
    public function it_renders_the_chosen_heading_level(string $strip, array $data, string $key, string $class): void
    {
        $this->assertTag('h4', $class, $strip::render([...$data, $key => 'h4'])->render());
    }

    #[Test]
    #[DataProvider('strips')]
    public function it_renders_no_heading_when_chosen(string $strip, array $data, string $key, string $class): void
    {
        $html = $strip::render([...$data, $key => 'none'])->render();

        self::assertDoesNotMatchRegularExpression('/<h[1-6][^>]*class="'.preg_quote($class, '/').'/', $html);
    }

    #[Test]
    #[DataProvider('strips')]
    public function it_falls_back_on_an_invalid_level(string $strip, array $data, string $key, string $class, string $tag): void
    {
        $this->assertTag($tag, $class, $strip::render([...$data, $key => 'h9'])->render());
    }

    #[Test]
    public function it_maps_legacy_hero_heading_fields(): void
    {
        $html = HeroStrip::render(['content' => 'Welkom', 'buttons' => [], 'heading' => true, 'heading_number' => '3'])->render();
        $this->assertTag('h3', 'hero-heading', $html);

        $html = HeroStrip::render(['content' => 'Welkom', 'buttons' => [], 'heading' => false, 'heading_number' => '1'])->render();
        $this->assertTag('span', 'hero-heading', $html);
    }

    #[Test]
    public function the_new_hero_heading_level_wins_over_legacy_fields(): void
    {
        $html = HeroStrip::render([
            'content' => 'Welkom',
            'buttons' => [],
            'heading' => true,
            'heading_number' => '1',
            'heading_level' => 'h2',
        ])->render();

        $this->assertTag('h2', 'hero-heading', $html);
    }

    #[Test]
    public function the_news_index_hero_include_renders_an_h1(): void
    {
        $html = view('strips.hero-strip', ['content' => 'Nieuwsberichten', 'buttons' => [], 'heading_level' => 'h1'])->render();

        $this->assertTag('h1', 'hero-heading', $html);
    }

    #[Test]
    public function it_resolves_heading_levels_of_repeater_items(): void
    {
        $this->assertTag('span', 'timeline-item__name', TimelineStrip::render(self::timeline())->render());
        $this->assertTag('h3', 'team-member__name', BoardMembersStrip::render(self::boardMembers())->render());
        $this->assertTag('h3', 'block-card__title', BlocksContentStrip::render(self::blocks())->render());

        $timeline = self::timeline();
        $timeline['items'][0]['name_level'] = 'h3';
        $this->assertTag('h3', 'timeline-item__name', TimelineStrip::render($timeline)->render());

        $members = self::boardMembers();
        $members['members'][0]['name_level'] = 'none';
        $this->assertTag('span', 'team-member__name', BoardMembersStrip::render($members)->render());

        $blocks = self::blocks();
        $blocks['items'][0]['title_level'] = 'h2';
        $this->assertTag('h2', 'block-card__title', BlocksContentStrip::render($blocks)->render());
    }

    #[Test]
    public function it_resolves_heading_levels_of_core_values(): void
    {
        $data = self::coreValues();
        $this->assertTag('h3', 'core-card__title', CoreValuesStrip::render($data)->render());

        $data['values'][0]['title_level'] = 'h4';
        $html = CoreValuesStrip::render($data)->render();
        self::assertMatchesRegularExpression('/<h4 class="core-card__title[^"]*">\s*Waarde\s*<\/h4>/', $html);
    }

    #[Test]
    public function it_strips_html_from_legacy_core_values_titles(): void
    {
        $html = CoreValuesStrip::render(self::coreValues())->render();

        self::assertStringContainsString('Onze waarden &amp; meer', $html);
        self::assertStringNotContainsString('<strong>waarden', $html);
    }

    #[Test]
    public function it_wraps_the_faq_question_button_in_a_heading_when_chosen(): void
    {
        $html = FaqStrip::render(self::faq())->render();
        self::assertStringNotContainsString('faq-item__heading', $html);

        $data = self::faq();
        $data['items'][0]['title_level'] = 'h3';
        $html = FaqStrip::render($data)->render();

        self::assertMatchesRegularExpression('/<h3 class="faq-item__heading m-0">\s*<button/', $html);
        self::assertMatchesRegularExpression('/<\/button>\s*<\/h3>/', $html);
    }

    #[Test]
    public function it_renders_the_column_subtitle_heading_level(): void
    {
        $column = ['type' => 'text', 'subtitle' => 'Over ons', 'content' => '<p>Tekst</p>', 'buttons' => []];

        $html = TwoColumnsStrip::render(['left_columns' => [$column], 'right_columns' => []])->render();
        $this->assertTag('span', 'column-text__eyebrow', $html);

        $html = TwoColumnsStrip::render(['left_columns' => [[...$column, 'subtitle_level' => 'h2']], 'right_columns' => []])->render();
        $this->assertTag('h2', 'column-text__eyebrow', $html);

        $html = ThreeColumnStrip::render([
            'left_columns' => [[...$column, 'subtitle_level' => 'h3']],
            'middle_columns' => [],
            'right_columns' => [],
        ])->render();
        $this->assertTag('h3', 'column-text__eyebrow', $html);
    }

    private function assertTag(string $tag, string $class, string $html): void
    {
        self::assertMatchesRegularExpression(
            '/<'.$tag.'\b[^>]*class="'.preg_quote($class, '/').'/',
            $html,
            "Verwachtte <{$tag}> met class \"{$class}\"."
        );
    }

    /** @return array<string, mixed> */
    private static function faq(): array
    {
        return ['subtitle' => null, 'title' => 'Vragen', 'items' => [['title' => 'Vraag?', 'image' => null, 'content' => '<p>Antwoord</p>']]];
    }

    /** @return array<string, mixed> */
    private static function timeline(): array
    {
        return ['subtitle' => null, 'title' => 'Tijdlijn', 'items' => [['name' => '2020', 'image' => null, 'alt' => null, 'content' => '<p>Mijlpaal</p>']]];
    }

    /** @return array<string, mixed> */
    private static function boardMembers(): array
    {
        return ['subtitle' => null, 'title' => 'Bestuur', 'description' => null, 'members' => [['role' => 'Voorzitter', 'name' => 'Sanne', 'image' => null, 'description' => null]]];
    }

    /** @return array<string, mixed> */
    private static function blocks(): array
    {
        return ['subtitle' => null, 'content' => null, 'items' => [['image' => null, 'subtitle' => null, 'title' => 'Blok', 'content' => null]]];
    }

    /** @return array<string, mixed> */
    private static function coreValues(): array
    {
        return [
            'subtitle' => 'Kernwaarden',
            'title' => '<p>Onze <strong>waarden</strong> &amp; meer</p>',
            'values' => [['icon' => 'rocket', 'title' => 'Waarde', 'content' => null]],
        ];
    }
}
