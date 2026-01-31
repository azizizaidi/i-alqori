<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Saade\FilamentLaravelLog\FilamentLaravelLogPlugin;
use Awcodes\FilamentVersions\VersionsPlugin;
use Awcodes\FilamentVersions\VersionsWidget;
use ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthPlugin;
// use Amendozaaguiar\FilamentRouteStatistics\FilamentRouteStatisticsPlugin;
use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Allowance;
//use Filament\Pages\Auth\Login;


class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {

        return $panel
            ->default()
            ->id('admin')
            ->path('')
            ->authGuard('web')
            ->darkMode(false)
           // ->spa()
           ->login() 
            ->profile()
            ->colors([
                'primary' => Color::Rose,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
               // Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->sidebarCollapsibleOnDesktop()
            ->widgets([
               Widgets\AccountWidget::class,
             //   Widgets\FilamentInfoWidget::class,
              //  VersionsWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                \Hasnayeen\Themes\Http\Middleware\SetTheme::class
            ])


           // ->plugin(
                //\Hasnayeen\Themes\ThemesPlugin::make()
               // ->canViewThemesPage(fn () => auth()->user()->is_admin)
              //  ->canViewThemesPage(fn () => auth()->user()->roles->contains(1)),


          //  )
          //  ->plugin(
             //   FilamentLaravelLogPlugin::make()
         //   )

            ->plugins([
              //  VersionsPlugin::make()



               // ->widgetColumnSpan('full'),
            ])
            ->plugin(FilamentSpatieRolesPermissionsPlugin::make())
       
            //->brandName('i-ALQORI')
    ->colors([
        'primary' => '#e53e3e', // Set your choice of colors
    ])
    ->renderHook(
      
            'panels::auth.login.form.after',
            fn () => view('filament.login_extra')
        
    )
            ->plugins([
                // FilamentRouteStatisticsPlugin::make(),
            ])
            ->favicon(asset('images/fav-2.png'))
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->authMiddleware([
                Authenticate::class,
            ]);
          

    }
}
