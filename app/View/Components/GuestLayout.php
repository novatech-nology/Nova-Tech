<?php
// Comentario Nova Tech: Arquivo app/View/Components/GuestLayout.php. Origem: Camada de componentes PHP do Blade. Conteudo: Classe PHP que liga layouts ou componentes Blade ao Laravel.

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.guest');
    }
}
