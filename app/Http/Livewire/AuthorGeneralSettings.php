<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\BlogSetting;

class AuthorGeneralSettings extends Component
{
    public $blog_settings;
    public $blog_name, $blog_email, $blog_description;
    public function mount()
    {
        $this->blog_settings = BlogSetting::find(1);
        $this->blog_name = $this->blog_settings->blog_name;
        $this->blog_email = $this->blog_settings->blog_email;
        $this->blog_description = $this->blog_settings->blog_description;
    }
    public function updateGeneralSettings()
    {
        $this->validate([
            'blog_name' => 'required',
            'blog_email' => 'required|email',
            'blog_description' => 'required'
        ]);
        $update = $this->blog_settings->update([
            'blog_name' => $this->blog_name,
            'blog_email' => $this->blog_email,
            'blog_description' => $this->blog_description,
        ]);
        if($update){
            $this->showToaster('General Settings have been successfully updated','success');
        }
        else{
            $this->showToaster('Something went wrong','error');
        }
    }
    public function showToaster($message,$type)
    {
        return $this->dispatchBrowserEvent('showToaster',[
            'type'=>$type,
            'message'=>$message
        ]);
    }
    public function render()
    {
        return view('livewire.author-general-settings');
    }
}
