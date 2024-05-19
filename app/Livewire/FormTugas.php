<?php

namespace App\Livewire;

use App\Models\Tugas;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

class FormTugas extends Component implements HasForms
{
    use InteractsWithForms;
    public function render()
    {
        return view('livewire.form-tugas');
    }
}
