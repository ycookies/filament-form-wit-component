<?php

namespace Ycookies\FormWitComponent\Filament\Pages;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\SettingsPage;
use Ycookies\FormWitComponent\Forms\Components\WeekTimePicker;
use Filament\Forms\Components\Fieldset;

class FormWitComponentPage extends SettingsPage
{
    //public static string $view = 'formwitcomponent::index';
    //public static ?string $navigationLabel = 'form-wit-component';
    //public static ?string $navigationIcon = 'heroicon-c-archive-box-arrow-down';

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $title = '智能表单组件';
    protected static string $settings = \App\Models\User::class;

    // 定义表单数据
    public ?array $data = [];

    public function getTitle(): string
    {
        return __('form-wit-component');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('form-wit-component');
    }

    // 定义表单结构
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Label')
                    ->schema([
                        TextInput::make('title1'),
                        TextInput::make('title2'),
                        TextInput::make('title3'),
                        TextInput::make('title4'),
                        TextInput::make('title5'),
                        TextInput::make('title6')
                    ])
                    ->columns(5),
                WeekTimePicker::make('week_time')
                    ->label(__('formwitcomponent::messages.task.week_time'))
                    ->required()
                    ->validationMessages([
                        'required' => '请选择周时间段',
                    ]),
                TextInput::make('title')
                    ->label(__('formwitcomponent::messages.task.title'))
                    ->required()
                    ->maxLength(255),

                MarkdownEditor::make('description')
                    ->label(__('formwitcomponent::messages.task.description'))
                    ->columnSpanFull(),

                Select::make('priority')
                    ->label('优先级')
                    ->options([
                        'low' => '低',
                        'medium' => '中',
                        'high' => '高',
                    ])
                    ->default('medium')
                    ->required(),

                DateTimePicker::make('due_date')
                    ->label('截止日期')
                    ->required(),

                Select::make('status')
                    ->label('状态')
                    ->options([
                        'pending' => '待处理',
                        'in_progress' => '进行中',
                        'completed' => '已完成',
                    ])
                    ->default('pending')
                    ->required(),
            ])
            ->columns(2);
    }


}
