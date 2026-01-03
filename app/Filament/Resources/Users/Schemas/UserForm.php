<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\CheckboxList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserForm
{
    public static function schema(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->required()
                ->maxLength(255),

            TextInput::make('email')
                ->email()
                ->required()
                ->unique(ignoreRecord: true),

            TextInput::make('password')
                ->password()
                ->revealable()
                ->dehydrateStateUsing(fn($state) => filled($state) ? Hash::make($state) : null)
                ->dehydrated(fn($state) => filled($state)),

            Select::make('role')
                ->options([
                    'super-admin' => 'Super Admin',
                    'admin' => 'Admin',
                    'user' => 'User',
                ])
                ->default('user')
                ->live()
                ->afterStateUpdated(function ($state, callable $set) {
                    if ($state === 'user') {
                        $set('permissions', []);
                    }
                }),

            CheckboxList::make('permissions')
                ->options(fn(callable $get) => $get('role') === 'user'
                    ? ['dashboard.view' => 'Lihat Dashboard']
                    : [
                        'user.view' => 'Lihat User',
                        'user.manage' => 'Kelola User',
                    ])
                ->visible(function (): bool {
                    $auth = Auth::user();
                    return $auth instanceof User && $auth->isSuperAdmin();
                })

        ]);
    }
}
