<?php

namespace Modules\FormWitComponent\Forms\Components;

use Filament\Forms\Components\Field;

class WeekTimePicker extends Field
{
    protected string $view = 'formwitcomponent::components.week-time-picker';

    /**
     * List of supported locales
     */
    protected $supportedLocales = [
        'en',
        'zh_CN',
        'zh_TW'
    ];

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->default('');
        
        // Set default locale
        $this->setLocale();
    }
    
    public function configure(): static
    {
        parent::configure();
        
        // Add additional configurations here
        $this->setLocale();
        
        return $this;
    }

    /**
     * Set the application locale
     */
    protected function setLocale(): void
    {
        $locale = session('locale', config('app.locale'));
        // If locale is not supported, fallback to English
        if (!in_array($locale, $this->supportedLocales)) {
            $locale = 'en';
        }
        
        app()->setLocale($locale);
    }

    /**
     * Get current locale
     */
    public function getCurrentLocale(): string
    {
        return app()->getLocale();
    }

    /**
     * Check if locale is supported
     */
    public function isLocaleSupported(string $locale): bool
    {
        return in_array($locale, $this->supportedLocales);
    }
}
