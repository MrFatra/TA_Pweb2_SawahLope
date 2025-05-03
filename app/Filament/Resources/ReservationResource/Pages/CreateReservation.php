<?php

namespace App\Filament\Resources\ReservationResource\Pages;

use App\Filament\Resources\ReservationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateReservation extends CreateRecord
{
    protected static string $resource = ReservationResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // masukkan data reservation_id, menu_id, dan quantity ke dalam tabel menu_reservation
        $data['menus'] = $this->form->getState()['menus'];
        $data['menus'] = array_map(function ($menu) {
            return [
                'menu_id' => $menu['menu_id'],
                'quantity' => $menu['quantity'],
            ];
        }, $data['menus']);
        $data['menus'] = array_filter($data['menus'], function ($menu) {
            return !empty($menu['menu_id']) && !empty($menu['quantity']);
        });
        return $data;
    }
}
