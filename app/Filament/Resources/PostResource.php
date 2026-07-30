<?php

namespace App\Filament\Resources;

use App\Enums\PostType;
use App\Filament\Resources\PostResource\Pages\CreatePost;
use App\Filament\Resources\PostResource\Pages\EditPost;
use App\Filament\Resources\PostResource\Pages\ListPosts;
use App\Models\Post;
use Closure;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedNewspaper;

    protected static ?int $navigationSort = 10;

    /**
     * Post::getRouteKey() returns the translated slug (for the public site's
     * pretty URLs), but Filament's own record-binding resolution doesn't go
     * through Post::resolveRouteBinding() — it needs this to match, or admin
     * edit links 404 (URL generated with the slug, resolved by id).
     */
    public static function getRecordRouteKeyName(): ?string
    {
        return 'slug->'.app()->getLocale();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('post')->columnSpanFull()->tabs([
                Tab::make(__('posts.section_content'))->schema([
                    TextInput::make('title')
                        ->label(__('posts.field_title'))
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                            if (filled($state) && blank($get('slug'))) {
                                $set('slug', Str::slug($state));
                            }
                        }),

                    TextInput::make('slug')
                        ->label(__('posts.field_slug'))
                        ->required()
                        ->maxLength(255)
                        ->rules([
                            fn (?Post $record): Closure => function (string $attribute, $value, Closure $fail) use ($record) {
                                $locale = app()->getLocale();

                                $exists = Post::query()
                                    ->where('slug->'.$locale, $value)
                                    ->when($record, fn ($query) => $query->whereKeyNot($record->getKey()))
                                    ->exists();

                                if ($exists) {
                                    $fail(__('posts.validation_slug_taken'));
                                }
                            },
                        ]),

                    TextInput::make('category')
                        ->label(__('posts.field_category'))
                        ->maxLength(255),

                    Textarea::make('excerpt')
                        ->label(__('posts.field_excerpt'))
                        ->rows(3)
                        ->maxLength(300)
                        ->columnSpanFull(),

                    RichEditor::make('body')
                        ->label(__('posts.field_body'))
                        ->toolbarButtons([
                            ['bold', 'italic', 'underline', 'strike', 'link'],
                            ['h2', 'h3'],
                            ['bulletList', 'orderedList'],
                            ['blockquote'],
                            ['undo', 'redo'],
                        ])
                        ->columnSpanFull(),
                ]),

                Tab::make(__('posts.section_media'))->schema([
                    FileUpload::make('cover_image')
                        ->label(__('posts.field_cover_image'))
                        ->image()
                        ->imageEditor()
                        ->disk('public')
                        ->directory('posts/covers')
                        ->maxSize(4096)
                        ->helperText(__('posts.help_cover')),

                    Repeater::make('images')
                        ->label(__('posts.field_gallery'))
                        ->relationship()
                        ->defaultItems(0)
                        ->schema([
                            FileUpload::make('path')
                                ->image()
                                ->imageEditor()
                                ->disk('public')
                                ->directory('posts/gallery')
                                ->maxSize(4096)
                                ->required(),
                            TextInput::make('alt')
                                ->label(__('posts.field_alt'))
                                ->maxLength(255),
                        ])
                        ->orderColumn('sort')
                        ->reorderableWithButtons()
                        ->collapsed()
                        ->itemLabel(fn (array $state): ?string => $state['alt'] ?? null)
                        ->columnSpanFull(),
                ]),

                Tab::make(__('posts.section_settings'))->schema([
                    Select::make('type')
                        ->label(__('posts.field_type'))
                        ->options(PostType::class)
                        ->required()
                        ->native(false),

                    Toggle::make('is_draft')
                        ->label(__('posts.draft'))
                        ->live()
                        ->default(true)
                        ->afterStateHydrated(function (Set $set, ?Post $record): void {
                            if ($record) {
                                $set('is_draft', blank($record->published_at));
                            }
                        }),

                    DateTimePicker::make('published_at')
                        ->label(__('posts.field_published_at'))
                        ->seconds(false)
                        ->helperText(__('posts.help_published_at'))
                        ->visible(fn (Get $get): bool => ! $get('is_draft')),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('cover_image')->label(''),
                TextColumn::make('title')->label(__('posts.field_title'))->searchable()->limit(60),
                TextColumn::make('type')->label(__('posts.field_type'))->badge(),
                TextColumn::make('published_at')
                    ->label(__('posts.field_published_at'))
                    ->dateTime('d M Y')
                    ->sortable()
                    ->placeholder(__('posts.draft')),
                TextColumn::make('images_count')
                    ->label(__('posts.column_images'))
                    ->counts('images'),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label(__('posts.field_type'))
                    ->options(PostType::class),
                TernaryFilter::make('published')
                    ->label(__('posts.filter_published'))
                    ->queries(
                        true: fn ($query) => $query->whereNotNull('published_at'),
                        false: fn ($query) => $query->whereNull('published_at'),
                    ),
            ])
            ->defaultSort('published_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPosts::route('/'),
            'create' => CreatePost::route('/create'),
            'edit' => EditPost::route('/{record}/edit'),
        ];
    }
}
